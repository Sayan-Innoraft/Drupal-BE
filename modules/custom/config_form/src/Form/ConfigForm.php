<?php

declare(strict_types=1);

namespace Drupal\config_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure ConfigForm settings for this site.
 */
final class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'config_form_config';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['config_form.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['emp_fullname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#maxLength' => 50,
    ];

    $form['emp_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#required' => TRUE,
      '#maxLength' => 11,
    ];

    $form['emp_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email Address'),
      '#required' => TRUE,
      '#maxLength' => 30,
    ];

    $form['emp_gender_select'] = [
      '#type' => 'radios',
      '#title' => $this->t('Select Gender'),
      '#options' => [
        'male' => $this->t('Male'),
        'female' => $this->t('Female'),
      ],
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Send'),
      ],
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    $form_data = $form_state->getValues();
    if(!preg_match("/^[\\p{L} .'-]+$/",$form_data['emp_fullname'])){
      $form_state->setErrorByName(
        'emp_fullname',
        $this->t('Enter a Valid Name.'),
      );
    }
    if(!preg_match('/^[7-9][0-9]{9}$/',$form_data['emp_number'])){
      $form_state->setErrorByName(
        'emp_number',
        $this->t('Enter a Valid Indian Number.'),
      );
    }

    if(!preg_match('/^[7-9][0-9]{9}$/',$form_data['emp_number'])){
      $form_state->setErrorByName(
        'emp_number',
        $this->t('Enter a Valid Indian Number.'),
      );
    }

    if(!preg_match('/\b[A-Za-z0-9._%+-]+@(gmail|yahoo|outlook|hotmail)\.com\b/'
      ,$form_data['emp_email'])){
      $form_state->setErrorByName(
        'emp_email',
        $this->t('Enter a Valid Email address of public domains like gmail, yahoo, outlook, hotmail with .com extension.'),
      );
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('config_form.settings')
      ->set('example', $form_state->getValue('example'))
      ->set('example', $form_state->getValue('example'))
      ->set('example', $form_state->getValue('example'))
      ->set('example', $form_state->getValue('example'))
      ->set('example', $form_state->getValue('example'))
      ->save();
    $this->messenger()->addStatus($this->t('The details has been saved.'));
    parent::submitForm($form, $form_state);
  }

}
