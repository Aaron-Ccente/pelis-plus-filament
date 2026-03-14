<?php
namespace App\Filament\Resources\Themes\Support;

use Filament\Support\Colors\Color;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;

class ThemeCssBuilder
{
 private function buildModeCss(?string $bg, ?string $text, string $prefix): string
{
    $p    = $prefix ? "{$prefix} " : '';
    $bgR  = $bg   ? "background-color: {$bg} !important;"   : '';
    $txtR = $text ? "color: {$text} !important;" : '';

    // PROTECCIÓN ESPECÍFICA PARA BORDES DE COLORPICKER Y SELECT
    $fixBorders = "
    /* ARREGLAR BORDES DE COLORPICKER */
    {$p} .fi-fo-color-picker,
    {$p} .fi-color-picker,
    {$p} [class*=\"color-picker\"] {
        border-radius: 0.375rem !important;
        overflow: hidden !important;
    }
    
    {$p} .fi-fo-color-picker button,
    {$p} .fi-color-picker button,
    {$p} .fi-fo-color-picker .fi-btn,
    {$p} .fi-color-picker .fi-btn {
        border-radius: 0.375rem !important;
    }
    
    {$p} .fi-color-picker-preview,
    {$p} [class*=\"color-picker-preview\"] {
        border-radius: 9999px !important;
    }
    
    /* ARREGLAR BORDES DEL SELECT - SIN overflow:hidden */
    {$p} .fi-select-input,
    {$p} .fi-select-wrp,
    {$p} .fi-input-wrp:has(select),
    {$p} select.fi-select-input {
        border-radius: 0.375rem !important;
        /* NO aplicar overflow hidden aquí */
    }
    
    /* Asegurar que el dropdown no herede estilos problemáticos */
    [data-floating-ui-portal],
    [data-floating-ui-portal] * {
        overflow: visible !important;
    }
    ";

    // Texto profundo (sin cambios)
    $txtDeep = $text ? "
    /* Tabla */
    {$p}.fi-ta-table thead th,
    {$p}.fi-ta-table thead th *,
    {$p}.fi-ta-col-header-cell,
    {$p}.fi-ta-col-header-cell span,
    {$p}.fi-ta-col-header-cell button,
    {$p}.fi-ta-table tbody td,
    {$p}.fi-ta-table tbody td *,
    /* Página */
    {$p}.fi-page-heading,
    {$p}.fi-page-sub-heading,
    {$p}.fi-breadcrumbs-item-label,
    /* Secciones y formularios */
    {$p}.fi-section-header-heading,
    {$p}.fi-section-header-description,
    {$p}.fi-fo-field-wrp-label,
    /* Inputs */
    {$p}.fi-input,
    {$p}.fi-input *,
    {$p}.fi-input-wrp,
    {$p}.fi-input-wrp input,
    {$p}.fi-input-wrp textarea,
    {$p}.fi-input-wrp select,
    {$p}.fi-select-input,
    {$p}.fi-select-option,
    {$p}.fi-combobox-input,
    {$p}.fi-combobox-option,
    {$p}.fi-date-time-picker-input,
    {$p}.fi-color-picker-input,
    /* Labels e hints */
    {$p}.fi-fo-field-wrp-hint,
    {$p}.fi-fo-field-wrp-helper-text,
    /* Badges y pills */
    {$p}.fi-badge,
    /* Elementos HTML genéricos dentro del panel */
    {$p}p, {$p}span, {$p}label,
    {$p}h1, {$p}h2, {$p}h3, {$p}h4, {$p}h5 {
        color: {$text} !important;
    }" : '';

    // Fondo de inputs (sin cambios)
    $bgInputs = $bg ? "
    {$p}.fi-input,
    {$p}.fi-input-wrp,
    {$p}.fi-input-wrp input,
    {$p}.fi-input-wrp textarea,
    {$p}.fi-input-wrp select,
    {$p}.fi-select-input,
    {$p}.fi-combobox-input,
    {$p}.fi-date-time-picker-input,
    {$p}.fi-color-picker-input {
        background-color: {$bg} !important;
    }" : '';

    return $fixBorders . "

    /* ── Estructura base ── */
    {$p}body,
    {$p}.fi-body,
    {$p}.fi-layout,
    {$p}.fi-layout-sidebar,
    {$p}.fi-main,
    {$p}.fi-main-ctn { {$bgR} {$txtR} }

    /* ── Sidebar ── */
    {$p}.fi-sidebar,
    {$p}.fi-sidebar-header,
    {$p}.fi-sidebar-nav { {$bgR} }
    {$p}.fi-sidebar-nav,
    {$p}.fi-nav-group-label,
    {$p}.fi-nav-item-label { {$txtR} }

    /* ── Topbar ── */
    {$p}.fi-topbar,
    {$p}.fi-topbar-nav { {$bgR} }

    /* ── Páginas ── */
    {$p}.fi-page,
    {$p}.fi-page-header,
    {$p}.fi-resource-list-page,
    {$p}.fi-resource-edit-page,
    {$p}.fi-resource-create-page,
    {$p}.fi-resource-view-page,
    {$p}.fi-dashboard-page { {$bgR} {$txtR} }

    /* ── Tabla: contenedores ── */
    {$p}.fi-ta,
    {$p}.fi-ta-ctn,
    {$p}.fi-ta-header,
    {$p}.fi-ta-header-toolbar,
    {$p}.fi-ta-content,
    {$p}.fi-ta-footer,
    {$p}.fi-ta-empty-state,
    {$p}.fi-ta-filters { {$bgR} {$txtR} }

    /* ── Tabla: thead (selectores HTML nativos) ── */
    {$p}.fi-ta-table,
    {$p}.fi-ta-table thead,
    {$p}.fi-ta-table thead tr,
    {$p}.fi-ta-table thead th { {$bgR} {$txtR} }

    /* ── Tabla: filas y celdas ── */
    {$p}.fi-ta-row,
    {$p}.fi-ta-cell { {$bgR} {$txtR} }

    /* ── Formularios y secciones ── */
    {$p}.fi-fo,
    {$p}.fi-fo-ctn,
    {$p}.fi-section,
    {$p}.fi-section-content,
    {$p}.fi-section-content-ctn { {$bgR} {$txtR} }

    /* ── Widgets ── */
    {$p}.fi-wi,
    {$p}.fi-wi-stats-overview,
    {$p}.fi-wi-stats-overview-stat { {$bgR} {$txtR} }

    /* ── Modales y slideovers ── */
    {$p}.fi-modal-window,
    {$p}.fi-slide-over-panel { {$bgR} {$txtR} }

    /* ── Texto profundo (sobrescribe clases Tailwind de color) ── */
    {$txtDeep}

    /* ── Fondo de inputs ── */
    {$bgInputs}
    ";
}

    public function loadTheme(): ?Theme
    {
        try {
            return Theme::where('user_id', Auth::id())->first();
        } catch (\Throwable) {
            return null;
        }
    }

    public function resolveColors(?Theme $theme): array
    {
        $defaults = [
            'primary'   => Color::Amber,
            'secondary' => Color::Blue,   // fallback si no hay tema
        ];

        if (! $theme || empty($theme->data)) {
            return $defaults;
        }

        $map = [
            'primary'   => 'primary_color',
            'secondary' => 'secondary_color',
            'success'   => 'success_color',
            'warning'   => 'warning_color',
            'danger'    => 'danger_color',
            'info'      => 'info_color',
        ];

        $colors = [];
        foreach ($map as $filamentKey => $dataKey) {
            if (! empty($theme->data[$dataKey])) {
                $colors[$filamentKey] = Color::hex($theme->data[$dataKey]);
            }
        }

        if (empty($colors['primary'])) {
            return $defaults;
        }

        // Si no hay secondary en el tema, lo derivamos del primary
        // desplazando el hue +30° (armonía análoga) para que tenga sentido visual
        if (empty($colors['secondary']) && ! empty($theme->data['primary_color'])) {
            $hex = ltrim($theme->data['primary_color'], '#');
            $r   = hexdec(substr($hex, 0, 2)) / 255;
            $g   = hexdec(substr($hex, 2, 2)) / 255;
            $b   = hexdec(substr($hex, 4, 2)) / 255;
            $max = max($r, $g, $b);
            $min = min($r, $g, $b);
            $l   = ($max + $min) / 2;
            $d   = $max - $min;
            $h   = 0;
            if ($d > 0) {
                $s = $l < 0.5 ? $d / ($max + $min) : $d / (2 - $max - $min);
                $h = match(true) {
                    $max === $r => fmod(($g - $b) / $d + 6, 6),
                    $max === $g => ($b - $r) / $d + 2,
                    default     => ($r - $g) / $d + 4,
                };
                $h = (int) round($h * 60);
            }
            // Hue +30°, misma sat/light que el primary
            $newHue = ($h + 30) % 360;
            $newH   = $newHue / 360;
            $s2     = isset($s) ? $s : 0.6;
            $l2     = $l;
            $q      = $l2 < 0.5 ? $l2 * (1 + $s2) : $l2 + $s2 - $l2 * $s2;
            $p2     = 2 * $l2 - $q;
            $hue2rgb = function(float $p, float $q, float $t): float {
                if ($t < 0) $t += 1; if ($t > 1) $t -= 1;
                if ($t < 1/6) return $p + ($q - $p) * 6 * $t;
                if ($t < 1/2) return $q;
                if ($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
                return $p;
            };
            $nr = (int) round($hue2rgb($p2, $q, $newH + 1/3) * 255);
            $ng = (int) round($hue2rgb($p2, $q, $newH)       * 255);
            $nb = (int) round($hue2rgb($p2, $q, $newH - 1/3) * 255);
            $derivedHex = sprintf('#%02x%02x%02x', $nr, $ng, $nb);
            $colors['secondary'] = Color::hex($derivedHex);
        }

        return $colors;
    }

    public function renderThemeCss(?Theme $theme): string
    {
        if (! $theme) {
            return '';
        }

        $light = $theme->data      ?? [];
        $dark  = $theme->data_dark ?? [];

        $lightBg   = $light['background_color'] ?? null;
        $lightText = $light['text_color']        ?? null;
        $darkBg    = $dark['background_color']   ?? null;
        $darkText  = $dark['text_color']         ?? null;

        $lightCss = ($lightBg || $lightText) ? ThemeCssBuilder::buildModeCss($lightBg, $lightText, '') : '';
        $darkCss  = ($darkBg  || $darkText)  ? ThemeCssBuilder::buildModeCss($darkBg,  $darkText,  '.dark') : '';

        // Variables CSS para colores semánticos en AMBOS modos
        $lightColorVars = $this->buildColorVars($light, ':root');
        $darkColorVars = $this->buildColorVars($dark, '.dark');

        if (! $lightCss && ! $darkCss && ! $lightColorVars && ! $darkColorVars) {
            return '';
        }

        return "<style>\n/* ── Tema personalizado ── */{$lightCss}{$darkCss}{$lightColorVars}{$darkColorVars}\n</style>";
    }

    /**
     * Genera variables CSS para colores semánticos en cualquier modo
     * 
     * @param array $colors Array de colores (data o data_dark)
     * @param string $selector Selector CSS (':root' para modo claro, '.dark' para modo oscuro)
     */
    private function buildColorVars(array $colors, string $selector): string
    {
        $map = [
            'primary'   => $colors['primary_color']   ?? null,
            'secondary' => $colors['secondary_color'] ?? null,
            'success'   => $colors['success_color']   ?? null,
            'warning'   => $colors['warning_color']   ?? null,
            'danger'    => $colors['danger_color']    ?? null,
            'info'      => $colors['info_color']      ?? null,
        ];

        $vars = '';
        foreach ($map as $name => $hex) {
            if (! $hex) continue;

            try {
                $scale = Color::hex($hex);
            } catch (\Throwable) {
                continue;
            }

            foreach ($scale as $shade => $rgb) {
                $vars .= "    --{$name}-{$shade}: {$rgb};\n";
            }
        }

        if (! $vars) return '';

        return "
        {$selector} {
        {$vars}
        }";
    }

}