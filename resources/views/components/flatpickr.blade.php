<div wire:ignore>
    <input
        x-data="{
            selectedDate: $wire.entangle('{{ $attributes->wire('model')->value() }}'){{ $attributes->has('wire:model.defer') ? '.defer' : '' }},
            pickrInstance: null,
            init() {
                var defaultOptions = {
                    dateFormat: 'Y-m-d H:i:s',
                    enableTime: false,
                    altFormat: 'j F Y',
                    altInput: true,
                    locale: {
                        firstDayOfWeek: 1,
                        weekdays: {
                            shorthand: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
                            longhand: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado']
                        },
                        months: {
                            shorthand: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                            longhand: ['Enero','Febreo','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']
                        }
                    },
                    onOpen: function(selectedDates, dateStr, instance){
                        document.querySelectorAll('.modal').forEach( modal => modal.removeAttribute('tabindex'));
                    },
                    onClose: function(selectedDates, dateStr, instance){
                        document.querySelectorAll('.modal').forEach( modal => modal.setAttribute('tabindex', -1));
                    }   
                };

                var options = {{ $attributes->get('options', '{}') }};

                Object.keys(options).forEach(config => defaultOptions[config] = options[config]);

                if (defaultOptions.enableTime) {
                    defaultOptions.altFormat = 'j F Y h:i K';
                }

                this.pickrInstance = flatpickr(this.$refs.datePickerInput, defaultOptions);

                $watch('selectedDate', function (value) {
                    this.pickrInstance.setDate(value);
                }.bind(this));
            }
        }"
        x-ref="datePickerInput"
        x-model="selectedDate"
        type="text"
        {{ $attributes->merge(['class' => 'form-input w-full rounded-md shadow-sm mb-2']) }}
    />
</div>