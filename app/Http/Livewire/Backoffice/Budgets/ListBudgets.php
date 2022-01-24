<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ListBudgets extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__('budgets.name'), 'event_name')->sortable(),
            Column::make(__('budgets.customer'), 'event_from_at')->sortable(),
            Column::make(__('budgets.status'), 'status')->sortable(),
            Column::make(__('budgets.date_from'), 'event_to_at')->sortable(),
            Column::make(__('budgets.date_to'), 'customer.name')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.budgets.row-budgets';
    }

    public function query(): Builder
    {
        return Budget::query()->when(
            $this->getFilter('search'),
            fn ($query, $term) => $query
                ->where('event_name', 'like', '%' . $term . '%')
                ->orWhereHas('customer', fn ($q) => $q->where('name', 'like', '%' . $term . '%')->orWhere('lastname', 'like', '%' . $term . '%'))
        );
    }

    /**
     * Print Remito
     *
     * @return mixed
     */
    public function printRemito($id)
    {
        $budget = Budget::find($id);

        // Get new PDF invoice name
        $number = "LR-" . time();
        $pdfName = $number . ".pdf";

        // Start PDF document
        $pdf = new \TCPDF('P', 'mm', 'A3', true, 'UTF-8', false);
        $pdf->SetTitle('Remito');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetAuthor('Remito');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();

        // Start PDF content
        $html = '<table style="width: 100%; padding:3px;">
            <tbody style="border-left: 6px solid #0087C3;">
            <tr>
              <td style="font-size: 20px;">La Rural S.A.</td>
              <td></td>
              <td></td>
              <td style="font-size: 20px; text-align: right;">REMITO</td>
            </tr>
            <tr>
              <td>JUNCAL 4431 - C.P.:(1425),</td>
              <td></td>
              <td></td>
              <td style="text-align:right; font-weight: bold;">N°: ' . $number . '</td>
            </tr>
            <tr>
              <td>CAPITAL FEDERAL</td>
              <td></td>
              <td></td>
              <td style="text-align:right; font-weight: bold;">Fecha: ' . now()->format('d/m/Y') . '</td>
            </tr>
          </tbody>


        </table>';






        $html .= '<table style="width: 100%; margin-top: 20px; padding:3px;">
            <tbody>
              <tr>
                <td colspan="3">___________________________________________________________________________________________________________________</td>
              </tr>
              <tr>
                <td><span style="font-weight: bold;">SR(ES):</span> ' . $budget->customer->full_name . '</td>
                <td></td>
                <td style="text-align: right;"><span style="font-weight: bold;">FECHA:</span> ' . $budget->event_from_at->format('d/m/Y') . ' al ' . $budget->event_to_at->format('d/m/Y') . '</td>
              </tr>
              <tr>
                <td><span style="font-weight: bold;">RAZÓN SOCIAL:</span> ' . $budget->customer->business_name . '</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="3">___________________________________________________________________________________________________________________</td>
              </tr>
            </tbody>
          </table>';


        $html .= '<table border="0" style="padding: 3px;">
            <thead>
              <tr>
                <th style="width:10%; font-weight: bold;">Cantidad</th>
                <th style="width:60%; font-weight: bold;">Description</th>
                <th style="width:60%; font-weight: bold;">Zona</th>
              </tr>
            </thead>
            <tbody>';

        // Add lines to invoice
        if ($budget->items->count() > 0) {
            // Multiple lines
            foreach ($budget->items as $item) {
                $html .= '<tr>
                        <td style="width:10%;text-align: center;">' . $item->product_qty . '</td>
                        <td style="width:60%;">' . $item->product->name . '</td>
                        <td style="width:60%;">' . $item->zone->name . ', ' . $item->subZone->name . '</td>
                      </tr>';
            }
        }

        $html .= '</tbody>
            <tfoot>
            <tr>
                <td colspan="3">___________________________________________________________________________________________________________________</td>
              </tr>
            <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td style="font-size: 12px;"><span style="font-weight: bold;">Subtotal:</span>
                  $' . $budget->total_without_discount . '
                </td>
              </tr>';

        $html .= '

              <tr>
                <td></td>
                <td></td>
                <td style="font-size: 12px;"><span style="font-weight: bold;">Descuento:</span> ' . $budget->discount . '%</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td style="font-size: 12px;"><span style="font-weight: bold;">Total:</span> $' . $budget->total . '</td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td colspan="3" style="">RECIBÍ CONFORME ________________________________________________________________________________</td>
              </tr>
            </tfoot>
          </table>
          ';


        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        if (!is_dir(public_path('uploads'))) {
            mkdir(public_path('uploads'), 755);
        }
        if (!is_dir(public_path('uploads/remitos'))) {
            mkdir(public_path('uploads/remitos'), 755);
        }

        $pdf->Output(public_path('uploads/remitos/' . $pdfName), 'F');

        $this->emit('newRemito', asset('uploads/remitos/' . $pdfName));
        return $pdf;
    }
}
