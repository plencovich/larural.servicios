function formattedDate(date) {
    let day = date.getDate()
    let month = date.getMonth() + 1
    let year = date.getFullYear()

    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }

    return {
        day,
        month,
        year
    };
}

function lang(value, choice = null) {
    // Split string if it has dots
    let keys = value.split('.');
    let i = 0;
    var trans = window.language;

    while (i < keys.length) {
        if (choice != null) {
            // Get correct string if choice is provided
            if (typeof trans[keys[i]] === 'string') {
                if (typeof choice === 'object') {
                    let string = trans[keys[i]];
                    Object.keys(choice).forEach(key => {
                        // Proceed if actual value is string
                        if (trans[keys[i]].includes(':' + key)) {
                            // Set value
                            string = string.replace(':' + key, choice[key])
                        }
                    });
                    // Set value
                    trans = string;
                } else {
                    // Proceed if actual value is string
                    if (trans[keys[i]].includes('|')) {
                        // Split string
                        let multi = trans[keys[i]].split('|');

                        // Select correct value
                        trans = multi.filter(x => x.includes(`{${choice}}`));

                        // Set value
                        trans = trans[0].replace(`{${choice}}`, '')
                    }
                }
            } else {
                // Set next value if it's an object
                trans = trans[keys[i]];
            }
        } else {
            // Get string if no choice is provided
            trans = trans[keys[i]];
        }

        // Get value if no translation is found
        if (!trans) {
            return value;
        };

        // Go to next string or object
        i++;
    }

    // Return translation
    return trans;
}

function select2Options() {
    return {
        language: "es",
        width: '100%'
    };
}

globals = {
    formattedDate: date => {
        return formattedDate(date);
    },
    initSelect2: () => {
        if ($('.select2').length) {
            $('.select2').select2(select2Options());
            $('.select2').on('change', function (e) {
                var data = $(this).select2("val");
                Livewire.emit('updateSelect', $(this).attr('name'), data);
            });
        }
    },
    initDatePicker: () => {
        let date = new Date();
        if (document.querySelector('.datepicker')) {
            new DateRangePicker(document.querySelector('.datepicker'), {
                // "autoApply": true,
                "minDate": `${formattedDate(date).day}/${formattedDate(date).month}/${formattedDate(date).year}`,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": lang('date.apply'),
                    "cancelLabel": lang('date.cancel'),
                    "fromLabel": lang('date.from'),
                    "toLabel": lang('date.to'),
                    "customRangeLabel": lang('date.custom'),
                    "weekLabel": lang('date.week-letter'),
                    "daysOfWeek": [
                        lang('date.su'),
                        lang('date.mo'),
                        lang('date.tu'),
                        lang('date.we'),
                        lang('date.th'),
                        lang('date.fr'),
                        lang('date.sa'),
                    ],
                    "monthNames": [
                        lang('date.january'),
                        lang('date.february'),
                        lang('date.march'),
                        lang('date.april'),
                        lang('date.may'),
                        lang('date.june'),
                        lang('date.july'),
                        lang('date.august'),
                        lang('date.september'),
                        lang('date.october'),
                        lang('date.november'),
                        lang('date.december'),
                    ],
                    "firstDay": 1
                },
            }, function (start, end) {
                // Set date range to livewire
                window.livewire.emit('changeDateRange', start, `${formattedDate(end._d).year}-${formattedDate(end._d).month}-${formattedDate(end._d).day}`);
            })
        }
    },
    lang: (value, choice = null) => {
        return lang(value, choice = null);
    },
    select2Options: () => {
        return {
            language: "es",
            width: '100%'
        };
    }
}