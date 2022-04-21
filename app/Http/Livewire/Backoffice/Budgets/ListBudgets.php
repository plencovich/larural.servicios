<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ListBudgets extends DataTableComponent
{

  public function columns(): array
  {
    return [
      Column::make(__('budgets.event'), 'event_name')->sortable(),
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
        ->whereHas('event', fn ($q) => $q->where('name', 'like', '%' . $term . '%'))
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
    $number = "RM-" . sprintf("%08s", $id);
    $pdfName = $number . ".pdf";

    // Start PDF document
    $pdf = new \TCPDF('P', 'mm', 'A3', true, 'UTF-8', false);
    $pdf->SetTitle('Remito');
    $pdf->SetHeaderMargin(30);
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->SetAuthor('La Rural');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();

    // Set text
    $eventFrom = $budget->event_from_at ? $budget->event_from_at->format('d/m/Y') : null;
    $eventTo = $budget->event_to_at ? $budget->event_to_at->format('d/m/Y') : null;

    // Set date text
    $dateRangeText = __('remito.no-dates');
    if ($eventFrom && $eventTo) {
      $dateRangeText = $eventFrom . ' ' . __('remito.to') . ' ' . $eventTo;
    } elseif ($eventFrom && !$eventTo) {
      $dateRangeText = $eventFrom;
    }

    $text = [
      'address1' => Str::upper(__('remito.address1')),
      'address2' => Str::upper(__('remito.address2')),
      'company' => __('remito.company'),
      'date' => __('remito.date'),
      'date_range' => $dateRangeText,
      'description' => __('remito.description'),
      'discount' => __('remito.discount'),
      'quantity' => __('remito.quantity'),
      'sign' => Str::upper(__('remito.sign')),
      'social' => Str::upper(__('remito.social')),
      'sr' => Str::upper(__('remito.sr')),
      'subtotal' => __('remito.subtotal'),
      'total' => __('remito.total'),
      'zone' => __('remito.zone'),
    ];

    // Start PDF content
    $html = '<table style="width: 100%; padding:3px;">
            <tbody style="border-left: 6px solid #0087C3;">
            <tr>
              <td style="font-size: 20px;">' . $text['company'] . '</td>
              <td></td>
              <td></td>
              <td style="font-size: 20px; text-align: right;">REMITO</td>
            </tr>
            <tr>
              <td>' . $text['address1'] . '</td>
              <td></td>
              <td></td>
              <td style="text-align:right; font-weight: bold;">N°: ' . $number . '</td>
            </tr>
            <tr>
              <td>' . $text['address2'] . '</td>
              <td></td>
              <td></td>
              <td style="text-align:right; font-weight: bold;">' . $text['date'] . ': ' . now()->format('d/m/Y') . '</td>
            </tr>
          </tbody>
        </table>';

    $html .= '<table style="width: 100%; margin-top: 20px; padding:3px;">
            <tbody>
              <tr>
                <td colspan="3">___________________________________________________________________________________________________________________</td>
              </tr>
              <tr>
                <td><span style="font-weight: bold;">' . $text['sr'] . ':</span> ' . $budget->customer->full_name . '</td>
                <td></td>
                <td style="text-align: right;"><span style="font-weight: bold;">' . $text['date'] . ':</span> ' . $text['date_range'] . '</td>
              </tr>
              <tr>
                <td><span style="font-weight: bold;">' . $text['social'] . ':</span> ' . $budget->customer->business_name . '</td>
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
                <th style="width:10%; font-weight: bold;">' . $text['quantity'] . '</th>
                <th style="width:60%; font-weight: bold;">' . $text['description'] . '</th>
                <th style="width:60%; font-weight: bold;">' . $text['zone'] . '</th>
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
          </table>
          <table>
            <tbody>
            <tr>
                <td colspan="3">___________________________________________________________________________________________________________________</td>
              </tr>
            <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td style="font-size: 12px; text-align: right;"><span style="font-weight: bold;">' . $text['subtotal'] . ':</span>
                  $' . $budget->total_without_discount . '
                </td>
              </tr>';

    $html .= '

              <tr>
                <td></td>
                <td></td>
                <td style="font-size: 12px; text-align: right;"><span style="font-weight: bold;">' . $text['discount'] . ':</span> ' . $budget->discount_formatted . '%</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td style="font-size: 12px; text-align: right;"><span style="font-weight: bold;">' . $text['total'] . ':</span> $' . $budget->total . '</td>
              </tr>
              <tr>
                <td colspan="3" style="text-align: right;">
                  <span style="font-size: 10px; color: #4e4e4e;">' . __('remito.footer-note') . '</span>
                </td>
              </tr>
              <tr>
                <td colspan="3">' . $budget->observations . '</td>
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
                <td colspan="3" style="">' . $text['sign'] . ' ________________________________________________________________________________</td>
              </tr>
            </tbody>
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
