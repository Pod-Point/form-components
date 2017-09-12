<?php

namespace PodPoint\Tests;

use DOMDocument;
use \PodPoint\FormComponents\FormComponentsServiceProvider;

class ViewFormComponentsTest extends TestCase
{
    /**
     * Check that the container form-group component displays correctly with the default classes used.
     *
     * @param DOMDocument $dom
     */
    private function testFormGroupDisplaysDefaultClasses(DOMDocument $dom)
    {
        $this->assertTrue(str_contains($dom->getElementsByTagName('div')[0]->getAttribute('class'), FormComponentsServiceProvider::FIELD_ROW_DEFAULT_CLASS));
        $this->assertTrue(str_contains($dom->getElementsByTagName('div')[1]->getAttribute('class'), 'form-field-wrapper'));
    }

    /**
     * Check that the container form-group component displays correctly with any custom classes used.
     *
     * @param DOMDocument $dom
     * @param array $data
     */
    private function testFormGroupDisplaysCustomClasses(DOMDocument $dom, array $data)
    {
        $this->assertTrue(str_contains($dom->getElementsByTagName('div')[0]->getAttribute('class'), $data['classes']['fieldRow']));
        // Move span/label into element test!
        $this->assertTrue(str_contains($dom->getElementsByTagName('span')[0]->getAttribute('class'), $data['classes']['label']));
        $this->assertTrue(str_contains($dom->getElementsByTagName('div')[1]->getAttribute('class'), $data['classes']['fieldWrapper']));
    }

    /**
     * Check that a single checkbox displays correctly with the options passed to it and with default classes used.
     */
    public function testSingleCheckboxDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name'        => 'myCheckbox',
            'labelText'   => 'Choose option(s)',
            'options'     => [
                'option1' => 'Option 1',
            ],
            'values'      => ['option1'],
            'disabled'    => true,
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
        ];

        $optionKey = key($data['options']);
        $optionText = $data['options'][$optionKey];

        echo $this->renderBladeView('checkbox', $data);
        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $this->testFormGroupDisplaysDefaultClasses($dom);

        $spanLabel = $dom->getElementsByTagName('span')[0];
        $this->assertTrue(str_contains($spanLabel->getAttribute('class'), 'form__label'));
        $this->assertTrue(str_contains($spanLabel->firstChild->wholeText, $data['labelText']));

        $this->assertTrue(str_contains($dom->getElementsByTagName('label')[0]->getAttribute('for'), $data['name']));

        $this->assertTrue(str_contains($dom->getElementsByTagName('span')[1]->textContent, $optionText));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue($input->getAttribute('type') === 'checkbox');
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('value') === $optionKey);
        $this->assertNotNull($input->getAttribute('checked'));
        $this->assertNotNull($input->getAttribute('disabled'));
    }

    /**
     * Check that a single checkbox displays any custom classes used.
     */
    public function testSingleCheckboxDisplaysCustomClasses()
    {
        $data = [
            'name'        => 'myCheckbox',
            'labelText'   => 'Choose option(s)',
            'options'     => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'values'      => ['option1'],
            'disabled'    => true,
            'classes' => [
                'fieldRow' => 'myFieldRowClass',
                'hasContent' => 'myHasContentClass',
                'hasError' => 'myHasErrorClass',
                'label' => 'myLabelClass',
                'fieldWrapper' => 'myFieldWrapperClass',
                'inputContainer' => 'myInputContainerClass',
                'input' => 'myInputClass',
                'errorMessage' => 'myErrorMessageClass',
            ],
        ];

        echo $this->renderBladeView('checkbox', $data);
        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $this->testFormGroupDisplaysCustomClasses($dom, $data);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['inputContainer']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "<span class=\"form__label\">{$data['labelText']}</span>"));
        $this->assertTrue(str_contains($renderedView, "<label class=\"checkbox {$data['labelClass']}\" for=\"{$data['name']}\">"));
        $this->assertTrue(str_contains($renderedView, "value=\"{$data['values'][0]}\""));
        $this->assertTrue(str_contains($renderedView, "<span>{$data['options']['option1']}</span>"));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }

    /**
     * Check that multiple checkboxes displays correctly with the options passed to them
     * - multiple group checkboxes are named slightly differently to singe checkboxes.
     */
    public function testCheckboxesDisplayCorrectlyWithDefaultClasses()
    {
        $data = [
            'name'        => 'someCheckbox',
            'labelText'   => 'Choose option(s)',
            'options'     => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'values'      => ['option1'],
            'disabled'    => true,
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $this->testFormGroupDisplaysDefaultClasses($dom);

        // *** Find a more elegant way to do labels (and span texts?)
        $labels = $dom->getElementsByTagName('label');
        foreach($labels as $label) {
            $this->assertTrue(str_contains($label->getAttribute('class'), 'checkbox'));
            $labelFors[] = $label->getAttribute('for');
        }

        $spans = $dom->getElementsByTagName('span');
        foreach($spans as $span) {
            $spanTexts[] = $span->textContent;
        }

        foreach($data['options'] as $optionKey => $optionText) {
            $this->assertTrue(in_array("{$data['name']}[{$optionKey}]", $labelFors));

            $this->assertTrue(in_array($optionText, $spanTexts));

            $input = $dom->getElementById("{$data['name']}[{$optionKey}]");
            $this->assertNotNull($input);
            $this->assertTrue($input->getAttribute('type') === 'checkbox');
            $this->assertTrue($input->getAttribute('name') === "{$data['name']}[{$optionKey}]");
            $this->assertTrue($input->getAttribute('value') === $optionKey);
            if (in_array($optionKey, $data['values'])) {
                $this->assertNotNull($input->getAttribute('checked'));
            }
            $this->assertNotNull($input->getAttribute('disabled'));
        }
    }

    /**
     * Check that multiple checkboxes display any custom classes used.
     */
    public function testCheckboxesDisplayCustomClasses()
    {
        $data = [
            'name'        => 'myCheckbox',
            'labelText'   => 'Choose option(s)',
            'options'     => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'values'      => ['option1'],
            'disabled'    => true,
            'classes' => [
                'fieldRow' => 'myFieldRowClass',
                'hasContent' => 'myHasContentClass',
                'hasError' => 'myHasErrorClass',
                'label' => 'myLabelClass',
                'fieldWrapper' => 'myFieldWrapperClass',
                'inputContainer' => 'myInputContainerClass',
                'input' => 'myInputClass',
                'errorMessage' => 'myErrorMessageClass',
            ],
        ];

        echo $this->renderBladeView('checkbox', $data);
        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $this->testFormGroupDisplaysCustomClasses($dom, $data);

        $labels = $dom->getElementsByTagName('label');
        foreach($labels as $label) {
            $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['inputContainer']));
        }

        $inputs = $dom->getElementsByTagName('input');
        foreach($inputs as $input) {
            $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
        }
        $this->assertTrue(substr_count($renderedView, 'checked') === 1);
        $this->assertTrue(str_contains($renderedView, 'disabled'));
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }

    /**
     * Check that a text input displays correctly with the options passed to it.
     */
    public function testInputDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name'        => 'myTextbox',
            'type'        => 'text',
            'labelText'   => 'Type here',
            'value'       => 'Some text',
            'placeholder' => 'Some hint',
            'disabled'    => true,
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
        ];

        echo $this->renderBladeView('input', $data);
        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('input', $data));

        $this->testFormGroupDisplaysDefaultClasses($dom);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), 'form__label'));
        $this->assertTrue(str_contains($label->getAttribute('for'), $data['name']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue($input->getAttribute('type') === 'checkbox');
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('value') === $optionKey);
        if ($optionKey === $data['values'][0]) {
            $this->assertNotNull($input->getAttribute('checked'));
        }
        $this->assertNotNull($input->getAttribute('disabled'));

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
     * Check that a text input displays correctly with any custom classes.
     */
    public function testInputDisplaysCustomClasses()
    {
        $data = [
            'name'        => 'myTextbox',
            'type'        => 'text',
            'labelText'   => 'Type here',
            'value'       => 'Some text',
            'placeholder' => 'Some hint',
            'disabled'    => true,
            'classes' => [
                'fieldRow' => 'myFieldRowClass',
                'hasContent' => 'myHasContentClass',
                'hasError' => 'myHasErrorClass',
                'label' => 'myLabelClass',
                'fieldWrapper' => 'myFieldWrapperClass',
                'input' => 'myInputClass',
                'errorMessage' => 'myErrorMessageClass',
            ],
        ];

        echo $this->renderBladeView('input', $data);
        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('input', $data));

        $this->testFormGroupDisplaysDefaultClasses($dom);

        $this->assertTrue(str_contains($dom->getElementsByTagName('label')[0]->getAttribute('for'), $data['name']));

        $this->assertTrue(str_contains($dom->getElementsByTagName('span')[1]->textContent, $optionText));

        $input = $dom->getElementById($data['name']);
        $this->assertNotNull($input);
        $this->assertTrue($input->getAttribute('type') === 'checkbox');
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('value') === $optionKey);
        if ($optionKey === $data['values'][0]) {
            $this->assertNotNull($input->getAttribute('checked'));
        }
        $this->assertNotNull($input->getAttribute('disabled'));

        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "type=\"{$data['type']}\""));
        $this->assertTrue(str_contains($renderedView, "<label class=\"form__label {$data['labelClass']}\" for=\"{$data['name']}\">{$data['labelText']}</label>"));
        $this->assertTrue(str_contains($renderedView, "value=\"{$data['value']}\""));
        $this->assertTrue(str_contains($renderedView, "placeholder=\"{$data['placeholder']}\""));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }

    /**
     * Check that a file upload input displays correctly with the options passed to it.
     */
    public function testFileUploadDisplaysWithCorrectOptions()
    {
        $data = [
            'name'        => 'someFileUploader',
            'labelText'   => 'Upload a file',
            'labelClass'  => 'some-class',
            'disabled'    => true,
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
        ];

        $renderedView = $this->renderBladeView('file-upload', $data);

        $this->assertTrue(str_contains($renderedView, '<input'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "<label class=\"form__label {$data['labelClass']}\" for=\"{$data['name']}\">{$data['labelText']}</label>"));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }

    /**
     * Check that radio buttons display correctly with the options passed to them.
     */
    public function testRadiosDisplayWithCorrectOptions()
    {
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
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
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
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }

    /**
     * Check that a select (dropdown) displays correctly with the options passed to it.
     */
    public function testSelectDisplaysWithCorrectOptions()
    {
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
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
        ];

        $renderedView = $this->renderBladeView('select', $data);

        $this->assertTrue(str_contains($renderedView, "<span class=\"form__label {$data['labelClass']}\">{$data['labelText']}</span>"));
        $this->assertTrue(str_contains($renderedView, '<select'));
        foreach($data['options'] as $option => $optionValue) {
            $this->assertTrue(str_contains($renderedView, "<select class=\"form__control\""));
            $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
            $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
            $this->assertTrue(str_contains($renderedView, "value=\"{$option}\""));
            $this->assertTrue(str_contains($renderedView, "{$optionValue}"));
        }
        $this->assertTrue(substr_count($renderedView, 'selected') === 1);
        $this->assertTrue(str_contains($renderedView, 'disabled'));
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }

    /**
     * Check that a text area displays correctly with the options passed to it.
     */
    public function testTextAreaDisplaysWithCorrectOptions()
    {
        $data = [
            'name'        => 'someTextArea',
            'type'        => 'text',
            'labelText'   => 'Type some text here',
            'labelClass'  => 'some-class',
            'value'       => 'Some text',
            'placeholder' => 'Some hint',
            'disabled'    => true,
            'attributes'     => [
                'attribute1' => 'Attribute value',
            ],
        ];

        $renderedView = $this->renderBladeView('textarea', $data);

        $this->assertTrue(str_contains($renderedView, '<textarea'));
        $this->assertTrue(str_contains($renderedView, "id=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "name=\"{$data['name']}\""));
        $this->assertTrue(str_contains($renderedView, "<label class=\"form__label {$data['labelClass']}\" for=\"{$data['name']}\">{$data['labelText']}</label>"));
        $this->assertTrue(str_contains($renderedView, "{$data['value']}"));
        $this->assertTrue(str_contains($renderedView, "placeholder=\"{$data['placeholder']}\""));
        $this->assertTrue(str_contains($renderedView, 'disabled'));
        $this->assertTrue(str_contains($renderedView, "attribute1=\"{$data['attributes']['attribute1']}\""));
    }
}
