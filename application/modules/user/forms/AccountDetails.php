<?php

/**
 * This is the user form.  It is in its own directory in the application 
 * structure because it represents a "composite asset" in your application.  By 
 * "composite", it is meant that the form encompasses several aspects of the 
 * application: it handles part of the display logic (view), it also handles 
 * validation and filtering (controller and model).  
 *
 * @uses       Zend_Form
 * @package    QuickStart
 * @subpackage Form
 */
class User_Form_AccountDetails extends Zend_Form {

    /**
     * init() is the initialization routine called when Zend_Form objects are 
     * created. In most cases, it make alot of sense to put definitions in this 
     * method, as you can see below.  This is not required, but suggested.  
     * There might exist other application scenarios where one might want to 
     * configure their form objects in a different way, those are best 
     * described in the manual:
     *
     * @see    http://framework.zend.com/manual/en/zend.form.html
     * @return void
     */
    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );
    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );

    public function init() {
        //$this->addElementPrefixPath('Base_Validate', 'Base/Validate/', 'validate');
        // Set the method for the display form to POST
        $this->setMethod('post');
		$this->addElementPrefixPath('Base_Validate', 'Base/Validate/', 'validate');
        /* $this->addElement('text', 'username', array(
          'label' => 'Username:*',
          'TABINDEX' => '1',
          'class' => 'form',
          'readonly' => true,
          'decorators' => $this->elementDecorators,
          'filters' => array('StringTrim'),
          )); */
        $this->addElement('text', 'fname', array(
            'label' => 'Name:*',
            'TABINDEX' => '1',
            'class' => 'form',
            'required' => true,
            'validators' => array(
                array('NotEmpty', true, array('messages' => array('isEmpty' => 'Please enter your name.'))),
            ),
            'size' => '50',
            'decorators' => $this->elementDecorators,
            'filters' => array('StringTrim'),
        ));
        $this->addElement('text', 'email', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', false, array(3, 50)),
            ),
            'required' => true,
            'validators' => array(
                'EmailAddress'
            )
            ,
            'class' => "form",
            'label' => 'Username/Email:*',
            'size' => '50',
            'autocomplete' => "off",
            'decorators' => $this->elementDecorators,
        ));




        $this->addElement('password', 'password', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('NotEmpty', true, array('messages' => array('isEmpty' => 'you have to fill in the password'))),
                //'Alnum',
                array('StringLength', true, array(6, 20), array('messages' => array('isEmpty' => 'Your password must be at least 6 characters long'))),
            ),
            'required' => true,
            'label' => 'Password:*',
            "class" => "form",
            "value" => "password",
            "onfocus" => "if( this.value=='password') value = '';",
            "onblur" => "if (this.value == '') this.value = 'password';",
            "onKeyPress" => "return submitenter(this,event)",
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('password', 'password', array(
                    'label' => 'Password:*',
                    'filters' => array('StringTrim'),
                    'decorators' => $this->elementDecorators,
                ))
                ->getElement('password')
                ->addValidator('IdenticalField', false, array('confirmPassword', 'confirm password'));

        // Add an password element
        $this->addElement('password', 'confirmPassword', array(
            'label' => 'Repeat password:*',
            'filters' => array('StringTrim'),
            'decorators' => $this->elementDecorators,
        ));



        $this->addElement('submit', 'login', array(
            'required' => false,
            'ignore' => true,
            'label' => 'change data',
            'class' => 'myButton',
            'decorators' => $this->buttonDecorators,
        ));
    }

    public function loadDefaultDecorators() {
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form',
        ));
    }

}