<?php

namespace App\Filament\Resources\Themes\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ThemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('user_id')
                ->default(Auth::id()),

                // ── MODO CLARO ────────────────────────────────────────────────
                Section::make('Modo claro')
                    ->description('Paleta de colores para el tema claro.')
                    ->icon('heroicon-o-sun')
                    ->columnSpan(1)
                    ->headerActions([
                        Action::make('generate_light')
                            ->label('Generar paleta')
                            ->color('secondary')
                            ->action(function ($livewire) {
                                $baseColor = $livewire->data['data']['base_color'] ?? null;
                                $palette   = static::generateHarmoniousPalette($baseColor, dark: false);

                                $livewire->data['data']['primary_color']    = $palette['primary'];
                                $livewire->data['data']['secondary_color']  = $palette['secondary'];
                                $livewire->data['data']['success_color']    = $palette['success'];
                                $livewire->data['data']['warning_color']    = $palette['warning'];
                                $livewire->data['data']['danger_color']     = $palette['danger'];
                                $livewire->data['data']['info_color']       = $palette['info'];
                                $livewire->data['data']['background_color'] = $palette['background'];
                                $livewire->data['data']['text_color']       = $palette['text'];
                            }),
                    ])
                    ->schema([
                        ColorPicker::make('data.base_color')
                            ->label('Color de fondo base')
                            ->helperText('Este color será el fondo. Los demás colores se generarán a partir de él.')
                            ->columnSpanFull()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                // Sincroniza base_color → background_color en tiempo real
                                if ($state) {
                                    $set('data.background_color', $state);
                                }
                            }),

                        ColorPicker::make('data.primary_color')    ->label('Primario'),
                        ColorPicker::make('data.secondary_color')  ->label('Secundario'),
                        ColorPicker::make('data.success_color')    ->label('Éxito'),
                        ColorPicker::make('data.warning_color')    ->label('Advertencia'),
                        ColorPicker::make('data.danger_color')     ->label('Peligro'),
                        ColorPicker::make('data.info_color')       ->label('Informativo'),
                        ColorPicker::make('data.background_color') ->label('Fondo'),
                        ColorPicker::make('data.text_color')       ->label('Texto'),
                    ])
                    ->columns(2),

                // ── MODO OSCURO ───────────────────────────────────────────────
                Section::make('Modo oscuro')
                    ->description('Paleta de colores para el tema oscuro.')
                    ->icon('heroicon-o-moon')
                    ->columnSpan(1)
                    ->headerActions([
                        Action::make('generate_dark')
                            ->label('Generar paleta')
                            ->color('secondary')
                            ->action(function ($livewire) {
                                $baseColor = $livewire->data['data_dark']['base_color']
                                    ?? $livewire->data['data']['base_color']
                                    ?? null;

                                $palette = static::generateHarmoniousPalette($baseColor, dark: true);

                                $livewire->data['data_dark']['primary_color']    = $palette['primary'];
                                $livewire->data['data_dark']['secondary_color']  = $palette['secondary'];
                                $livewire->data['data_dark']['success_color']    = $palette['success'];
                                $livewire->data['data_dark']['warning_color']    = $palette['warning'];
                                $livewire->data['data_dark']['danger_color']     = $palette['danger'];
                                $livewire->data['data_dark']['info_color']       = $palette['info'];
                                $livewire->data['data_dark']['background_color'] = $palette['background'];
                                $livewire->data['data_dark']['text_color']       = $palette['text'];
                            }),
                    ])
                    ->schema([
                        ColorPicker::make('data_dark.base_color')
                            ->label('Color de fondo base oscuro')
                            ->helperText('Este color será el fondo oscuro. Vacío para derivarlo del color base claro.')
                            ->columnSpanFull()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state) {
                                    $set('data_dark.background_color', $state);
                                }
                            }),

                        ColorPicker::make('data_dark.primary_color')    ->label('Primario'),
                        ColorPicker::make('data_dark.secondary_color')  ->label('Secundario'),
                        ColorPicker::make('data_dark.success_color')    ->label('Éxito'),
                        ColorPicker::make('data_dark.warning_color')    ->label('Advertencia'),
                        ColorPicker::make('data_dark.danger_color')     ->label('Peligro'),
                        ColorPicker::make('data_dark.info_color')       ->label('Informativo'),
                        ColorPicker::make('data_dark.background_color') ->label('Fondo'),
                        ColorPicker::make('data_dark.text_color')       ->label('Texto'),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * El color base ES el fondo. A partir de él se deriva toda la paleta:
     *
     * 1. background → el propio base_color (sin modificación)
     * 2. text       → máximo contraste sobre el fondo (claro u oscuro)
     * 3. primary    → versión más saturada/brillante del mismo hue
     * 4. secondary  → armonía análoga (+30°) o complementaria (+180°)
     * 5. semánticos → tonos fijos (verde/amarillo/rojo/cian) con la saturación
     *                 ajustada al tema
     *
     * El parámetro $dark fuerza que el fondo generado sea oscuro aunque el
     * base_color no lo sea (útil para el modo oscuro cuando no hay base propio).
     */
    public static function generateHarmoniousPalette(?string $baseColor = null, bool $dark = false): array
    {
        // ── 1. Extraer o generar el color de fondo ────────────────────────────
        if ($baseColor && preg_match('/^#?([a-fA-F0-9]{6})$/', $baseColor, $m)) {
            $hexClean = $m[1];
            [$bgHue, $bgSat, $bgLight] = static::hexToHsl('#' . $hexClean);

            // En modo oscuro si el color base es claro, invertimos la luminosidad
            if ($dark && $bgLight > 50) {
                $bgLight = 100 - $bgLight;          // espejo de luminosidad
                $bgLight = max(8, min(20, $bgLight)); // acotamos al rango oscuro
            }

            $background = static::hslToHex($bgHue, $bgSat, $bgLight);
        } else {
            // Sin base: generamos un fondo aleatorio según modo
            $bgHue  = rand(0, 359);
            $bgSat  = rand(5, 15);
            $bgLight = $dark ? rand(8, 16) : rand(93, 98);
            $background = static::hslToHex($bgHue, $bgSat, $bgLight);
        }

        // ── 2. Texto con máximo contraste sobre el fondo ──────────────────────
        // Si el fondo es oscuro (L < 50) → texto muy claro; si es claro → muy oscuro
        $bgIsDark   = $bgLight < 50;
        $textLight  = $bgIsDark ? rand(88, 96) : rand(8, 18);
        $text       = static::hslToHex($bgHue, rand(5, 12), $textLight);

        // ── 3. Primary: mismo hue que el fondo, más saturado y de luminosidad media
        //     Garantiza coherencia cromática con el fondo
        $primarySat   = max(55, min(85, $bgSat + rand(40, 60)));
        $primaryLight = $bgIsDark ? rand(55, 70) : rand(35, 50);
        $primary      = static::hslToHex($bgHue, $primarySat, $primaryLight);

        // ── 4. Secondary: armonía análoga (+30°) o complementaria (+180°) ─────
        $harmonyOffset  = (rand(0, 1) === 0) ? 30 : 180;
        $secondaryHue   = ($bgHue + $harmonyOffset) % 360;
        $secondarySat   = max(40, $primarySat - rand(5, 15));
        $secondaryLight = $bgIsDark
            ? min(80, $primaryLight + rand(5, 12))
            : max(25, $primaryLight - rand(5, 12));
        $secondary = static::hslToHex($secondaryHue, $secondarySat, $secondaryLight);

        // ── 5. Semánticos: tonos fijos, saturación ligada al primario ─────────
        $semanticSat    = max(50, $primarySat - 10);
        $semanticOffset = $bgIsDark ? 10 : 0;   // más luminosos sobre fondo oscuro

        $success = static::hslToHex((120 + rand(-10, 10) + 360) % 360, $semanticSat,                rand(35, 45) + $semanticOffset);
        $warning = static::hslToHex((45  + rand(-8,   8) + 360) % 360, min(95, $semanticSat + 15), rand(48, 56) + $semanticOffset);
        $danger  = static::hslToHex((0   + rand(-10, 10) + 360) % 360, min(90, $semanticSat + 10), rand(42, 52) + $semanticOffset);
        $info    = static::hslToHex((200 + rand(-10, 10) + 360) % 360, $semanticSat,                rand(40, 50) + $semanticOffset);

        return [
            'background' => $background,
            'text'       => $text,
            'primary'    => $primary,
            'secondary'  => $secondary,
            'success'    => $success,
            'warning'    => $warning,
            'danger'     => $danger,
            'info'       => $info,
        ];
    }
    // ──────────────────────────────────────────────────────────────────────────
    // Conversiones
    // ──────────────────────────────────────────────────────────────────────────

    protected static function hexToHsl(string $hex): array
    {
        $hex = ltrim($hex, '#');
        $r   = hexdec(substr($hex, 0, 2)) / 255;
        $g   = hexdec(substr($hex, 2, 2)) / 255;
        $b   = hexdec(substr($hex, 4, 2)) / 255;

        $max  = max($r, $g, $b);
        $min  = min($r, $g, $b);
        $diff = $max - $min;
        $l    = ($max + $min) / 2;

        if ($diff === 0.0) {
            return [0, 0, (int) round($l * 100)];
        }

        $s = $l < 0.5
            ? $diff / ($max + $min)
            : $diff / (2 - $max - $min);

        $h = match (true) {
            $max === $r => fmod(($g - $b) / $diff + 6, 6),
            $max === $g => ($b - $r) / $diff + 2,
            default     => ($r - $g) / $diff + 4,
        };

        return [
            (int) round($h * 60),
            (int) round($s * 100),
            (int) round($l * 100),
        ];
    }

    protected static function hslToHex(int $h, int $s, int $l): string
    {
        $h = $h / 360;
        $s = $s / 100;
        $l = $l / 100;

        if ($s === 0.0) {
            $r = $g = $b = (int) round($l * 255);
        } else {
            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;

            $r = (int) round(static::hueToRgb($p, $q, $h + 1 / 3) * 255);
            $g = (int) round(static::hueToRgb($p, $q, $h)         * 255);
            $b = (int) round(static::hueToRgb($p, $q, $h - 1 / 3) * 255);
        }

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    protected static function hueToRgb(float $p, float $q, float $t): float
    {
        if ($t < 0) $t += 1;
        if ($t > 1) $t -= 1;

        return match (true) {
            $t < 1 / 6 => $p + ($q - $p) * 6 * $t,
            $t < 1 / 2 => $q,
            $t < 2 / 3 => $p + ($q - $p) * (2 / 3 - $t) * 6,
            default    => $p,
        };
    }
}