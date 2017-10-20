<?php

namespace PodPoint\FormComponents;

use Illuminate\Support\ServiceProvider;

class FormComponentsServiceProvider extends ServiceProvider
{
    /**
     * Default class for form group div
     */
    const FORM_GROUP_DEFAULT_CLASS = 'form__group';

    /**
     * Default class for form group div error
     */
    const FORM_GROUP_ERROR_CLASS = 'form__group--error';

    /**
     * Default class for form error span
     */
    const FORM_ERROR_SPAN_CLASS = 'form__error';

    /**
     * Default class for text label appearing above some inputs
     */
    const LABEL_DEFAULT_CLASS = 'form__label';

    /**
     * Default class for button
     */
    const BUTTON_DEFAULT_CLASS = 'btn';

    /**
     * Default class for checkbox container
     */
    const CHECKBOX_CONTAINER_DEFAULT_CLASS = 'checkbox form__field';

    /**
     * Default class for checkbox
     */
    const CHECKBOX_DEFAULT_CLASS = 'form__control';

    /**
     * Default class for file upload input
     */
    const FILE_UPLOAD_DEFAULT_CLASS = 'form__control form__field';

    /**
     * Default class for text/password input
     */
    const INPUT_DEFAULT_CLASS = 'form__control form__field';

    /**
     * Default class for radio container
     */
    const RADIO_CONTAINER_DEFAULT_CLASS = 'radio form__field';

    /**
     * Default class for radio
     */
    const RADIO_DEFAULT_CLASS = 'form__control';

    /**
     * Default class for select container
     */
    const SELECT_CONTAINER_DEFAULT_CLASS = 'select form__field';

    /**
     * Default class for select
     */
    const SELECT_DEFAULT_CLASS = 'form__control';

    /**
     * Default class for textarea
     */
    const TEXTAREA_DEFAULT_CLASS = 'form__control form__field';

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
