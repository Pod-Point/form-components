<?php

namespace PodPoint\FormComponents;

use Illuminate\Support\ServiceProvider;

class FormComponentsServiceProvider extends ServiceProvider
{
    /**
     * Default class for field row div
     */
    const FIELD_ROW_DEFAULT_CLASS = 'form__group field-row';

    /**
     * Default class if field has value set
     */
    const HAS_CONTENT_DEFAULT_CLASS = 'hasContent';

    /**
     * Default class if field has validation error
     */
    const HAS_ERROR_DEFAULT_CLASS = 'hasError';

    /**
     * Default class for text label appearing above some inputs
     */
    const LABEL_DEFAULT_CLASS = 'form__label';

    /**
     * Default class for form field wrapper div
     */
    const FIELD_WRAPPER_DEFAULT_CLASS = 'form-field-wrapper';

    /**
     * Default class for error message
     */
    const ERROR_MESSAGE_DEFAULT_CLASS = 'form__error';

    /**
     * Default class for button container
     */
    const BUTTON_CONTAINER_DEFAULT_CLASS = 'form-action-buttons';

    /**
     * Default class for button
     */
    const BUTTON_DEFAULT_CLASS = 'button button--default';

    /**
     * Default class for checkbox container
     */
    const CHECKBOX_CONTAINER_DEFAULT_CLASS = 'checkbox';

    /**
     * Default class for file upload input
     */
    const FILE_UPLOAD_DEFAULT_CLASS = 'form__control button button--default upload';

    /**
     * Default class for text/password input
     */
    const INPUT_DEFAULT_CLASS = 'form__control';

    /**
     * Default class for radio container
     */
    const RADIO_CONTAINER_DEFAULT_CLASS = 'form__label radio';

    /**
     * Default class for radio
     */
    const RADIO_DEFAULT_CLASS = 'form__control';

    /**
     * Default class for select container
     */
    const SELECT_CONTAINER_DEFAULT_CLASS = 'select-wrapper';

    /**
     * Default class for select
     */
    const SELECT_DEFAULT_CLASS = 'form__control';

    /**
     * Default class for textarea
     */
    const TEXT_AREA_DEFAULT_CLASS = 'form__control';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'form');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
