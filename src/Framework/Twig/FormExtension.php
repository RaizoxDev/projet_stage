<?php

namespace App\Framework\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class FormExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('field', [$this, 'field'], [
                'is_safe'=> ['html'],
                'needs_context'=> true
                ])
        ];
    }

    public function field(array $context, string $key, $value, ?string $label = null, array $options = []): string
    {
        $type = $options['type'] ?? 'text';
        $error = $this->getErrorHtml($context, $key);
        $class = 'form-group';
        $value = $this->convertValue($value);
        $attributes = [
            'class' => trim('form-control ' . ($options['class'] ?? '')),
            'name'  => $key,
            'id'    => $key
        ];

        if ($error) {
            $class .= ' has-danger';
            $attributes['class'] .= ' is-invalid';
        }
        if ($type === 'textarea') {
            $input = $this->textarea($value, $attributes);
        } else if(array_key_exists('options', $options)) {
            $input = $this->select($value, $options['options'], $attributes);
        } else {
            $input = $this->input($value, $attributes);
        }
        return "<div class=\"" . $class . "\">
              <label for=\"name\">{$label}</label>
              {$input}
              {$error}
            </div>";
    }
    
    private function convertValue($value): string
    {
        if($value instanceof \DateTime) {
            return $value->format('Y-m-d H:i:s');
        }
        return (string)$value;
    }

    private function getErrorHTML($context, $key)
    {   
        $error= $context['errors'][$key] ?? false;
        if($error) {
            return "<small class=\"form-text text-muted\">{$error}</small>";
        }
        return "";
    }

    private function input(?string $value, array $attributes): string
    {
        return "<input type=\"text\" " . $this->getHtmlFromArray($attributes) . " value=\"{$value}\">";
    }

    private function textarea(?string $value, array $attributes): string
    {
        return "<textarea " . $this->getHtmlFromArray($attributes) . ">{$value}</textarea>";
    }

    private function select(?string $value, array $options, array $attributes)
    {
        $htmlOptions = array_reduce(array_keys($options),function (string $html, string $key) use ($options, $value) {
            $params = ['value' => $key, 'selected' => $key === $value];
            return $html . '<option ' .$this->getHtmlFromArray($params) . '>' . $options[$key] . '</option>';
        }, "");
        return "<select " . $this->getHtmlFromArray($attributes) . ">$htmlOptions</select>";
        
    }

    public function getHtmlFromArray(array $attributes)
    {
        $htmlParts = [];
        foreach($attributes as $key => $value) {
            if($value === true) {
                $htmlParts[] = (string) $key;
            } else if ($value !== false) {
                $htmlParts[] = "$key=\"$value\"";
            }
        }
        return implode( ' ', $htmlParts);
    }
}