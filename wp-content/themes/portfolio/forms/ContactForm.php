<?php

namespace Portfolio_Theme\Form;

class ContactForm
{
    protected array $rules = [];
    protected array $sanitizers = [];

    public function __construct()
    {
    }

    public function rule(string $field, string $rule): static
    {
        if(! array_key_exists($field, $this->rules)) {
            $this->rules[$field] = [];
        }

        $this->rules[$field][] = $rule;

        return $this;
    }

    public function handle(array $data): void
    {
        // Valider les données envoyées.
        if(is_array($errors = $this->validate($data))) {
            // En cas de problème de validation, renvoyer l'utilisateur sur la page précédente (où se trouvait le formulaire) afin d'y afficher les erreurs de validation.
            $_SESSION['dw_contact_form_errors'] = $errors;
            wp_safe_redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
        // Nettoyer les données (sanitize).
        // Sauvegarder l'envoi de formulaire en base de données.
        // Envoyer un mail de notification.
        // Renvoyer l'utilisateur vers la page précédente (où se trouvait le formulaire) afin d'y afficher un message de succès (feedback).
        $data = $this->cleanData($data);

        // Sauvegarder l'envoi de formulaire en base de données.
        // Envoyer un mail de notification.

        // Renvoyer l'utilisateur vers la page précédente (où se trouvait le formulaire) afin d'y afficher un message de succès (feedback).
        $_SESSION['dw_contact_form_success'] = 'Merci '.$data['firstname'].', votre message a bien été envoyé.';
        wp_safe_redirect($_SERVER['HTTP_REFERER']);
        exit;
    }
    protected function cleanData(array $data): array
    {
        $cleaned = [];

        foreach ($this->sanitizers as $field => $callback) {
            $cleaned[$field] = call_user_func($callback, $data[$field] ?? null);
        }

        return $cleaned;
    }

    protected function validate(array $data): bool|array
    {
        $errors = [];

        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                $method = 'check_'.$rule;
                $error = $this->$method($field, $data[$field] ?? null);
                if(! is_string($error)) continue;
                $errors[$field] = $error;
                break;
            }
        }

        return $errors ?: true;
    }

    protected function check_required(string $field, mixed $value): bool|string
    {
        if($value || $value == 0) {
            return true;
        }

        return 'Ce champ est requis.';
    }

    protected function check_valid_email(string $field, mixed $value): bool|string
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return 'L\'adresse mail n\'est pas valide.';
    }

    protected function check_no_test(string $field, mixed $value): bool|string
    {
        if(! is_string($value)) {
            return true;
        }

        if(strpos($value, 'test') === false) {
            return true;
        }

        return 'Ce champ ne peut pas contenir le mot "test".';
    }
    public function sanitize(string $field, string $callback): static
    {
        $this->sanitizers[$field] = $callback;

        return $this;
    }
}