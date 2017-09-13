<?php

namespace PodPoint\FormComponents\Tests;

use DOMDocument;
use \PodPoint\FormComponents\FormComponentsServiceProvider;

class ViewFormComponentsTest extends TestCase
{
    /**
     * Check that the form group used by most components displays with the default class used.
     *
     * @param DOMDocument $dom
     */
    private function checkFormGroupDisplaysWithDefaultClass(DOMDocument $dom)
    {
        $formGroupDiv = $dom->getElementsByTagName('div')[0];
        $this->assertTrue(str_contains($formGroupDiv->getAttribute('class'), FormComponentsServiceProvider::FORM_GROUP_DEFAULT_CLASS));
    }

    /**
     * Check that the form group used by most components displays with a custom class used.
     *
     * @param DOMDocument $dom
     * @param string $className
     */
    private function checkFormGroupDisplaysWithCustomClass(DOMDocument $dom, string $className)
    {
        $formGroupDiv = $dom->getElementsByTagName('div')[0];
        $this->assertFalse(str_contains($formGroupDiv->getAttribute('class'), FormComponentsServiceProvider::FORM_GROUP_DEFAULT_CLASS));
        $this->assertTrue(str_contains($formGroupDiv->getAttribute('class'), $className));
    }

    /**
     * Check that a button displays correctly with the options passed to it and the default classes used.
     */
    public function testButtonDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'myButton',
            'text' => 'Button text',
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('button', $data));

        $input = $dom->getElementsByTagName('button')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::BUTTON_DEFAULT_CLASS));
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue(str_contains($input->textContent, $data['text']));
        $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
        $this->assertTrue($input->hasAttribute('attribute2'));
        $this->assertFalse($input->hasAttribute('attribute3'));
    }

    /**
     * Check that a text input displays correctly with a custom element and custom classes used.
     */
    public function testButtonDisplaysWithCustomElementAndCustomClasses()
    {
        $data = [
            'element' => 'a',
            'text' => 'Button text',
            'classes' => [
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('button', $data));

        $input = $dom->getElementsByTagName($data['element'])[0];
        $this->assertNotNull($input);
        $this->assertFalse(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::BUTTON_DEFAULT_CLASS));
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
    }

    /**
     * Check that a single checkbox displays correctly with the options passed to it and default classes used.
     */
    public function testCheckboxDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'myCheckbox',
            'labelText' => 'Choose option(s)',
            'options' => [
                'option1' => 'Option 1',
            ],
            'values' => ['option1'],
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $optionKey = key($data['options']);
        $optionText = $data['options'][$optionKey];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $this->checkFormGroupDisplaysWithDefaultClass($dom);

        $spanLabel = $dom->getElementsByTagName('span')[0];
        $this->assertTrue(str_contains($spanLabel->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($spanLabel->firstChild->wholeText, $data['labelText']));

        $inputContainer = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($inputContainer->getAttribute('class'), FormComponentsServiceProvider::CHECKBOX_CONTAINER_DEFAULT_CLASS));
        $this->assertTrue(str_contains($inputContainer->getAttribute('for'), $data['name']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::CHECKBOX_DEFAULT_CLASS));
        $this->assertTrue($input->getAttribute('type') === 'checkbox');
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('value') === $optionKey);
        $this->assertTrue($input->hasAttribute('checked'));
        $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
        $this->assertTrue($input->hasAttribute('attribute2'));
        $this->assertFalse($input->hasAttribute('attribute3'));

        $checkboxText = $dom->getElementsByTagName('span')[1];
        $this->assertTrue(str_contains($checkboxText->textContent, $optionText));
    }

    /**
     * Check that multiple checkboxes display correctly with the options passed to them
     * - multiple group checkboxes are named differently to single checkboxes.
     */
    public function testMultipleCheckboxesDisplayCorrectly()
    {
        $data = [
            'name' => 'someCheckbox',
            'labelText' => 'Choose option(s)',
            'options' => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'values' => ['option1'],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $inputContainers = $dom->getElementsByTagName('label');
        $spans = $dom->getElementsByTagName('span');

        foreach($data['options'] as $optionKey => $optionText) {
            $inputContainer = array_first($inputContainers, function ($inputContainer) use ($data, $optionKey) {
                return $inputContainer->getAttribute('for') === "{$data['name']}[{$optionKey}]";
            });
            $this->assertNotNull($inputContainer);

            $span = array_first($spans, function ($span) use ($optionText) {
                return $span->textContent === $optionText;
            });
            $this->assertNotNull($span);

            $input = $dom->getElementById("{$data['name']}[{$optionKey}]");
            $this->assertNotNull($input);

            if (in_array($optionKey, $data['values'])) {
                $this->assertTrue($input->hasAttribute('checked'));
            }
        }
    }

    /**
     * Check that checkboxes display with custom classes used.
     */
    public function testCheckboxesDisplayWithCustomClasses()
    {
        $data = [
            'name' => 'myCheckbox',
            'labelText' => 'Choose option(s)',
            'options' => [
                'option1' => 'Option 1',
            ],
            'classes' => [
                'formGroup' => 'myFormGroupClass',
                'label' => 'myLabelClass',
                'inputContainer' => 'myInputContainerClass',
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('checkbox', $data));

        $this->checkFormGroupDisplaysWithCustomClass($dom, $data['classes']['formGroup']);

        $spanLabel = $dom->getElementsByTagName('span')[0];
        $this->assertFalse(str_contains($spanLabel->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($spanLabel->getAttribute('class'), $data['classes']['label']));

        $inputContainer = $dom->getElementsByTagName('label')[0];
        $this->assertFalse(str_contains($inputContainer->getAttribute('class'), FormComponentsServiceProvider::CHECKBOX_CONTAINER_DEFAULT_CLASS));
        $this->assertTrue(str_contains($inputContainer->getAttribute('class'), $data['classes']['inputContainer']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertFalse(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::CHECKBOX_DEFAULT_CLASS));
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
    }

    /**
     * Check that a file upload input displays correctly with the options passed to it and default classes used.
     */
    public function testFileUploadDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'someFileUploader',
            'labelText' => 'Upload a file',
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('file-upload', $data));

        $this->checkFormGroupDisplaysWithDefaultClass($dom);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->firstChild->wholeText, $data['labelText']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::FILE_UPLOAD_DEFAULT_CLASS));
        $this->assertTrue($input->getAttribute('type') === 'file');
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
        $this->assertTrue($input->hasAttribute('attribute2'));
        $this->assertFalse($input->hasAttribute('attribute3'));
    }

    /**
     * Check that a file upload input displays with custom classes used.
     */
    public function testFileUploadDisplaysWithCustomClasses()
    {
        $data = [
            'name' => 'someFileUploader',
            'labelText' => 'Upload a file',
            'classes' => [
                'formGroup' => 'myFormGroupClass',
                'label' => 'myLabelClass',
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('file-upload', $data));

        $this->checkFormGroupDisplaysWithCustomClass($dom, $data['classes']['formGroup']);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertFalse(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['label']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertFalse(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::FILE_UPLOAD_DEFAULT_CLASS));
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
    }

    /**
     * Check that a text input displays correctly with the options passed to it and the default classes used.
     */
    public function testInputDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'myTextbox',
            'labelText' => 'Type here',
            'value' => 'Some text',
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('input', $data));

        $this->checkFormGroupDisplaysWithDefaultClass($dom);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->getAttribute('for'), $data['name']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::INPUT_DEFAULT_CLASS));
        $this->assertTrue($input->getAttribute('type') === 'text');
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('value') === $data['value']);
        $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
        $this->assertTrue($input->hasAttribute('attribute2'));
        $this->assertFalse($input->hasAttribute('attribute3'));
    }

    /**
     * Check that a text input displays correctly with a custom type and custom classes used.
     */
    public function testInputDisplaysWithCustomTypeAndCustomClasses()
    {
        $data = [
            'name' => 'myTextbox',
            'type' => 'password',
            'labelText' => 'Type here',
            'classes' => [
                'formGroup' => 'myFormGroupClass',
                'label' => 'myLabelClass',
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('input', $data));

        $this->checkFormGroupDisplaysWithCustomClass($dom, $data['classes']['formGroup']);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['label']));

        $input = $dom->getElementsByTagName('input')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
        $this->assertTrue($input->getAttribute('type') === $data['type']);
    }

    /**
     * Check that radio buttons display correctly with the options passed to it and default classes used.
     */
    public function testRadiosDisplayCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'someRadioButtons',
            'labelText' => 'Choose option',
            'options' => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'value' => 'option1',
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('radio', $data));

        $this->checkFormGroupDisplaysWithDefaultClass($dom);

        $inputContainers = $dom->getElementsByTagName('label');
        $spans = $dom->getElementsByTagName('span');

        $spanLabel = $spans[0];
        $this->assertTrue(str_contains($spanLabel->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($spanLabel->firstChild->wholeText, $data['labelText']));

        foreach($data['options'] as $optionKey => $optionText) {
            $inputContainer = array_first($inputContainers, function ($inputContainer) use ($data, $optionKey) {
                return $inputContainer->getAttribute('for') === "{$data['name']}_{$optionKey}";
            });
            $this->assertNotNull($inputContainer);
            $this->assertTrue(str_contains($inputContainer->getAttribute('class'), FormComponentsServiceProvider::RADIO_CONTAINER_DEFAULT_CLASS));

            $input = $dom->getElementById("{$data['name']}_{$optionKey}");
            $this->assertNotNull($input);
            $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::RADIO_DEFAULT_CLASS));
            $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
            $this->assertTrue($input->hasAttribute('attribute2'));
            $this->assertFalse($input->hasAttribute('attribute3'));

            if ($optionKey === $data['value']) {
                $this->assertTrue($input->hasAttribute('checked'));
            }

            $span = array_first($spans, function ($span) use ($optionText) {
                return $span->textContent === $optionText;
            });
            $this->assertNotNull($span);
        }
    }

    /**
     * Check that radio buttons display correctly with custom classes used.
     */
    public function testRadiosDisplayCorrectlyWithCustomClasses()
    {
        $data = [
            'name' => 'someRadioButtons',
            'labelText' => 'Choose option',
            'options' => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'classes' => [
                'formGroup' => 'myFormGroupClass',
                'label' => 'myLabelClass',
                'inputContainer' => 'myInputContainerClass',
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('radio', $data));

        $this->checkFormGroupDisplaysWithCustomClass($dom, $data['classes']['formGroup']);

        $spanLabel = $dom->getElementsByTagName('span')[0];
        $this->assertFalse(str_contains($spanLabel->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($spanLabel->getAttribute('class'), $data['classes']['label']));

        $labels = $dom->getElementsByTagName('label');
        foreach($labels as $label) {
            $this->assertFalse(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::RADIO_CONTAINER_DEFAULT_CLASS));
            $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['inputContainer']));
        }

        foreach($data['options'] as $optionKey => $optionText) {
            $input = $dom->getElementById("{$data['name']}_{$optionKey}");
            $this->assertFalse(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::RADIO_DEFAULT_CLASS));
            $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
        }
    }

    /**
     * Check that a select (dropdown) displays correctly with the options passed to it and default classes used.
     */
    public function testSelectDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'someDropdown',
            'labelText' => 'Choose option',
            'options' => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'value' => 'option1',
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('select', $data));

        $this->checkFormGroupDisplaysWithDefaultClass($dom);

        $label = $dom->getElementsByTagName('span')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->firstChild->wholeText, $data['labelText']));

        $inputContainer = $dom->getElementsByTagName('div')[1];
        $this->assertTrue(str_contains($inputContainer->getAttribute('class'), FormComponentsServiceProvider::SELECT_CONTAINER_DEFAULT_CLASS));

        $input = $dom->getElementsByTagName('select')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::SELECT_DEFAULT_CLASS));
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
        $this->assertTrue($input->hasAttribute('attribute2'));
        $this->assertFalse($input->hasAttribute('attribute3'));

        $options = $dom->getElementsByTagName('option');

        foreach($data['options'] as $optionKey => $optionText) {
            $option = array_first($options, function ($option) use ($optionKey) {
                return $option->getAttribute('value') === $optionKey;
            });
            $this->assertNotNull($option);
            $this->assertTrue(str_contains($option->firstChild->wholeText, $optionText));

            if ($optionKey === $data['value']) {
                $this->assertTrue($option->hasAttribute('selected'));
            }
        }
    }

    /**
     * Check that a select (dropdown) displays with custom classes used.
     */
    public function testSelectDisplaysWithCustomClasses()
    {
        $data = [
            'name' => 'someDropdown',
            'labelText' => 'Choose option',
            'options' => [
                'option1' => 'Option 1',
                'option2' => 'Option 2',
            ],
            'classes' => [
                'formGroup' => 'myFormGroupClass',
                'label' => 'myLabelClass',
                'inputContainer' => 'myInputContainerClass',
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('select', $data));

        $this->checkFormGroupDisplaysWithCustomClass($dom, $data['classes']['formGroup']);

        $label = $dom->getElementsByTagName('span')[0];
        $this->assertFalse(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['label']));

        $inputContainer = $dom->getElementsByTagName('div')[1];
        $this->assertFalse(str_contains($inputContainer->getAttribute('class'), FormComponentsServiceProvider::SELECT_CONTAINER_DEFAULT_CLASS));
        $this->assertTrue(str_contains($inputContainer->getAttribute('class'), $data['classes']['inputContainer']));

        $input = $dom->getElementsByTagName('select')[0];
        $this->assertFalse(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::SELECT_DEFAULT_CLASS));
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
    }

    /**
     * Check that a textarea displays correctly with the options passed to it and default classes used.
     */
    public function testTextAreaDisplaysCorrectlyWithDefaultClasses()
    {
        $data = [
            'name' => 'someTextArea',
            'labelText' => 'Type some text here',
            'value' => 'Some text',
            'attributes' => [
                'attribute1' => 'Attribute value',
                'attribute2' => true,
                'attribute3' => false,
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('textarea', $data));

        $this->checkFormGroupDisplaysWithDefaultClass($dom);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertTrue(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->getAttribute('for'), $data['name']));

        $input = $dom->getElementsByTagName('textarea')[0];
        $this->assertTrue(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::TEXTAREA_DEFAULT_CLASS));
        $this->assertTrue($input->getAttribute('id') === $data['name']);
        $this->assertTrue($input->getAttribute('name') === $data['name']);
        $this->assertTrue($input->firstChild->wholeText === $data['value']);
        $this->assertTrue($input->getAttribute('attribute1') === $data['attributes']['attribute1']);
        $this->assertTrue($input->hasAttribute('attribute2'));
        $this->assertFalse($input->hasAttribute('attribute3'));
    }

    /**
     * Check that a textarea displays with custom classes used.
     */
    public function testTextAreaDisplaysWithCustomClasses()
    {
        $data = [
            'name' => 'someTextArea',
            'labelText' => 'Type some text here',
            'classes' => [
                'formGroup' => 'myFormGroupClass',
                'label' => 'myLabelClass',
                'input' => 'myInputClass',
            ],
        ];

        $dom = new DOMDocument();
        $dom->loadHTML($this->renderBladeView('textarea', $data));

        $this->checkFormGroupDisplaysWithCustomClass($dom, $data['classes']['formGroup']);

        $label = $dom->getElementsByTagName('label')[0];
        $this->assertFalse(str_contains($label->getAttribute('class'), FormComponentsServiceProvider::LABEL_DEFAULT_CLASS));
        $this->assertTrue(str_contains($label->getAttribute('class'), $data['classes']['label']));

        $input = $dom->getElementsByTagName('textarea')[0];
        $this->assertFalse(str_contains($input->getAttribute('class'), FormComponentsServiceProvider::TEXTAREA_DEFAULT_CLASS));
        $this->assertTrue(str_contains($input->getAttribute('class'), $data['classes']['input']));
    }
}
