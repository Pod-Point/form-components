<?php

namespace PodPoint\Tests\Functional;

use PodPoint\FormComponents\Tests\TestCase;

class ViewFormComponentsTest extends TestCase {

    /**
     * Check that a single checkbox displays correctly with the options passed to it.
     */
    public function testCheckboxDisplaysWithCorrectOptions() {
        $data = [
            'name'        => 'someCheckbox',
            'labelText'   => 'Choose option',
            'labelClass'  => 'some-class',
            'options'     => [
                'option1' => 'Option 1',
            ],
            'values'      => ['option1'],
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('checkbox', $data);

        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "<span class=\"form__label\">{$data['labelText']}</span>"));
        $this->assertTrue(str_contains($renderedView, "<label class=\"checkbox {$data['labelClass']}\" for=\"{$data['name']}\">"));
        $this->assertTrue(str_contains($renderedView, "value=\"{$data['values'][0]}\""));
        $this->assertTrue(str_contains($renderedView, "<span>{$data['options']['option1']}</span>"));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }

    /**
     * Check that multiple checkboxes displays correctly with the options passed to them
     * - multiple group checkboxes are named slightly differently to singe checkboxes.
     */
    public function testCheckboxesDisplayWithCorrectOptions() {
        $data = [
            'name'        => 'someCheckbox',
            'labelText'   => 'Choose option(s)',
            'labelClass'  => 'some-class',
            'options'     => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'values'      => ['option1'],
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('checkbox', $data);

        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "<span class=\"form__label\">{$data['labelText']}</span>"));
        foreach($data['options'] as $option => $optionValue) {
            $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}[{$option}]\""));
            $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}[{$option}]\""));
            $this->assertTrue(str_contains($renderedView, "<label class=\"checkbox {$data['labelClass']}\" for=\"{$data['name']}_{$option}\">"));
            $this->assertTrue(str_contains($renderedView, "value=\"{$option}\""));
            $this->assertTrue(str_contains($renderedView, "<span>{$optionValue}</span>"));
        }
        $this->assertTrue(substr_count($renderedView, 'checked') === 1);
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }

    /**
     * Check that a text input displays correctly with the options passed to it.
     */
    public function testInputDisplaysWithCorrectOptions() {
        $data = [
            'name'        => 'someTextbox',
            'type'        => 'text',
            'labelText'   => 'Type some text here',
            'labelClass'  => 'some-class',
            'value'       => 'Some text',
            'placeholder' => 'Some hint',
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('input', $data);

        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "type=\"{$data['type']}\""));
        $this->assertTrue(str_contains($renderedView, "<label class=\"form__label {$data['labelClass']}\" for=\"{$data['name']}\">{$data['labelText']}</label>"));
        $this->assertTrue(str_contains($renderedView, "value=\"{$data['value']}\""));
        $this->assertTrue(str_contains($renderedView, "placeholder=\"{$data['placeholder']}\""));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }

    /**
     * Check that a file upload input displays correctly with the options passed to it.
     */
    public function testFileUploadDisplaysWithCorrectOptions() {
        $data = [
            'name'        => 'someFileUploader',
            'labelText'   => 'Upload a file',
            'labelClass'  => 'some-class',
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('file-upload', $data);

        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "<label class=\"form__label {$data['labelClass']}\" for=\"{$data['name']}\">{$data['labelText']}</label>"));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }

    /**
     * Check that radio buttons display correctly with the options passed to them.
     */
    public function testRadiosDisplayWithCorrectOptions() {
        $data = [
            'name'        => 'someRadioButtons',
            'labelText'   => 'Choose option',
            'labelClass'  => 'some-class',
            'options'     => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'value'       => 'option1',
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('radio', $data);

        $this->assertTrue(str_contains($renderedView, '<input'));
        foreach($data['options'] as $option => $optionValue) {
            $this->assertTrue(str_contains($renderedView, "<label class=\"form__label radio {$data['labelClass']}\" for=\"{$data['name']}_{$option}\">"));
            $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}_{$option}\""));
            $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
            $this->assertTrue(str_contains($renderedView, "value=\"{$option}\""));
            $this->assertTrue(str_contains($renderedView, "<span>{$optionValue}</span>"));
        }
        $this->assertTrue(substr_count($renderedView, 'checked') === 1);
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }

    /**
     * Check that a select (dropdown) displays correctly with the options passed to it.
     */
    public function testSelectDisplaysWithCorrectOptions() {
        $data = [
            'name'        => 'someDropdown',
            'labelText'   => 'Choose option',
            'labelClass'  => 'some-class',
            'options'     => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'value'       => 'option1',
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('select', $data);

        $this->assertTrue(str_contains($renderedView, '<select'));
        foreach($data['options'] as $option => $optionValue) {
            $this->assertTrue(str_contains($renderedView, "<select class=\"form__control\" id=\"{$data['name']}\" name=\"{$data['name']}\""));
            $this->assertTrue(str_contains($renderedView, "value=\"{$option}\""));
            $this->assertTrue(str_contains($renderedView, "{$optionValue}"));
        }
        $this->assertTrue(substr_count($renderedView, 'selected') === 1);
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }

    /**
     * Check that a text area displays correctly with the options passed to it.
     */
    public function testTextAreaDisplaysWithCorrectOptions() {
        $data = [
            'name'        => 'someTextArea',
            'type'        => 'text',
            'labelText'   => 'Type some text here',
            'labelClass'  => 'some-class',
            'value'       => 'Some text',
            'placeholder' => 'Some hint',
            'disabled'    => true,
        ];

        $renderedView = $this->renderBladeView('textarea', $data);

        $this->assertTrue(str_contains($renderedView, '<textarea'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "<label class=\"form__label {$data['labelClass']}\" for=\"{$data['name']}\">{$data['labelText']}</label>"));
        $this->assertTrue(str_contains($renderedView, "{$data['value']}"));
        $this->assertTrue(str_contains($renderedView, "placeholder=\"{$data['placeholder']}\""));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
    }
}
