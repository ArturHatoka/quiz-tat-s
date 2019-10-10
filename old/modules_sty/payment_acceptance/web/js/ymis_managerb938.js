(function(){
    function YmisManager() {
        this.integration_id = 'yandex_money';
        this.form_root = $();
        this.module_price_id = false;

        this.submitFormSettings = function () {
            var data = {};
            var no_errors = true;

            ymis_manager.form_root = $('#yandex-money-ind-settings');

            ymis_manager.form_root.find('input').each(function () {
                if ($(this).attr('type') == 'checkbox') {
                    data[$(this).attr('name')] = $(this).prop('checked') ? 1 : 0;
                } else {
                    data[$(this).attr('name')] = $(this).val().trim();
                }
            });

            var errors = ymis_manager.validateFormSettings(data);

            for (var index in errors) {
                ymis_manager.form_root.find('div[parent-name=' + index + ']:first').html(errors[index].join('<br/>'));

                if (errors[index].length > 0) {
                    no_errors = false;

                    if (index == 'successURL') {
                        ymis_manager.form_root.find('#form_conf_buy_more').addClass('in').css({'height': 'auto'});
                    }
                }
            }

            if (no_errors) {
                var params = {
                    settings: data
                };
                params['form_id'] = pages_editor.$bottomEditor.data('curSmartObj').id;
                params['integration_id'] = ymis_manager.integration_id;

                saveMan.add('save_ymis_settings', params);
            }
            return no_errors;
        };

        this.onSaveSettings = function (params) {
            formEditor.setPaymentSettings(ymis_manager.integration_id, params.settings, params.form_id);
        };

        this.clearFormSettings = function ($form) {
            if (!sitesIntMan.isIntegrationEnabledForSite(ymis_manager.integration_id)) {
                $('#yandex-money-ind-settings').find('.lock-ind-settings:first').show();
            } else {
                $('#yandex-money-ind-settings').find('.lock-ind-settings:first').hide();
            }

            $form.find('input').each(function () {
                ymis_manager.form_root.find('div[parent-name=' + $(this).attr('name') + ']:first').html('');

                if ($(this).attr('type') == 'checkbox') {
                    $(this).prop('checked', false);
                } else {
                    $(this).val('');
                }
            });
        };

        this.getDefaultSettings = function () {
            return {
                wallet_number: '',
                targets: '',
                amount: '',
                formcomment: '',
                successURL: ''
            };
        };

        this.validateFormSettings = function (data) {
            var errors = {};

            for (var index in data) {

                errors[index] = [];

                if ($.inArray(index, ['wallet_number', 'targets', 'amount']) >= 0 && data[index].length == 0) {
                    errors[index].push('Поле обязательно для заполнения');
                }

                switch (index) {
                    case 'wallet_number':
                        if (/[^[0-9]/.test(data[index])) {
                            errors[index].push('Неверный формат. Допустимы только цифры');
                        }
                        break;
                    case 'amount':
                        data[index] = data[index].split(',').join('.');
                        if (/^\.|\d+\..*\.|[^\d\.{1}]/.test(data[index])) {
                            errors[index].push('Неверный формат. Допустимы только цифры');
                        }
                        if (('' !== data[index]) && (data[index].split('.')[0] < 2)) {
                            errors[index].push('Сумма должна быть не менее 2 рублей');
                        }
                        break;
                    case 'successURL':
                        if (data[index].length > 0 && !checkProtocolInUrl(data[index])) {
                            errors[index].push('Неверный формат URL');
                        }
                        break;
                    case 'targets':
                        if (data[index].length > 150) {
                            errors[index].push('максимальное значение поля 150 символов');
                        }
                        break;
                    case 'formcomment':
                        if (data[index].length > 50) {
                            errors[index].push('максимальное значение поля 50 символов');
                        }
                        break;
                }
            }

            return errors;
        };

        this.loadFormSettings = function (data) {
            var $input = $();
            var $form = $('#yandex-money-ind-settings');

            if ($form.length == 0) {
                return;
            }

            ymis_manager.clearFormSettings($form);

            if (typeof data == 'undefined' || typeof data.settings == 'undefined') {
                return;
            }

            for (var index in data.settings) {
                $input = $form.find('input[name=' + index + ']');
                if ($input.attr('type') == 'checkbox') {
                    $input.prop('checked', data.settings[index] == 1);
                } else {
                    $input.val(data.settings[index]);
                }
            }
        };

        this.submitLeadForm = function (form_id, lead_id, key, type) {
            var label = LpmBase64.encode(JSON.stringify({
                "lead_id": lead_id,
                "key": key
            }));

            var $form = $('#ymis_' + form_id);

            $form.find('input[name=paymentType]').val(type);
            $form.find('input[name=label]').val(label);

            $form.submit();
        };

        this.enabledModule = function () {
            var lock_id = lockScreen('Подключаем интеграцию!', {show_animation: true});

            saveMan.add('enabled_ymis_module', {"integration_id": ymis_manager.integration_id, "lock_id": lock_id});
        };

        this.afterEnabledModule = function (lock_id) {
            $('#yandex-money-ind-settings').find('#ymis-enabled-text:first').hide();
            $('#yandex-money-ind-settings').find('#ymis-msg:first').show();

            setTimeout(function () {
                $('#yandex-money-ind-settings').find('.lock-ind-settings:first').hide();
            }, 2000);

            sitesIntMan.onIntegrationEnabledForSite(ymis_manager.integration_id);

            unlockScreen(lock_id);
        }
    }

    FE.runOnReady(function(){
        window.ymis_manager = new YmisManager();

        FE.add('formEditor/loaded', function () {
            $('#yandex-money-ind-settings').find('input[name=successURL]').on('keyup', function () {
                var $input = $(this);
                var url = inputUrlProcessing($input.val());
                $input.val(url);
                $input = null;
            });
        });
    });
})();