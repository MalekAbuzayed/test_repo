<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subcategory;
use App\Models\SpecGroup;
use App\Models\SpecField;

class SpecTemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Generated from New Specs.xlsx
        $templates = [
            'Ongrid Inverters' => [
                ['title' => 'PV Input Specefications', 'sort_order' => 1, 'fields' => [
                    ['key' => 'max_input_voltage', 'label' => 'Max Input Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'mppt_voltage_range', 'label' => 'MPPT Voltage Range (V)', 'unit' => 'V', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'start_up_voltage', 'label' => 'Start-up Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 3],
                    ['key' => 'nominal_input_voltage', 'label' => 'Nominal Input Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_input_current_per_mppt', 'label' => 'Max Input Current Per MPPT (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'max_short_circuit_current_per_mppt', 'label' => 'Max Short Circuit Current Per MPPT (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 6],
                    ['key' => 'number_of_mpp_trackers', 'label' => 'Number of MPP Trackers', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 7],
                    ['key' => 'number_of_strings_per_mppt', 'label' => 'Number of Strings Per MPPT', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 8],
                ]],
                ['title' => 'Output Specefications', 'sort_order' => 2, 'fields' => [
                    ['key' => 'nominal_output_power', 'label' => 'Nominal Output Power (W)', 'unit' => 'W', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'nominal_output_apparent_power', 'label' => 'Nominal Output Apparent Power (VA)', 'unit' => 'VA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'max_ac_active_power', 'label' => 'Max. AC Active Power (W)', 'unit' => 'W', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'max_ac_apparent_power', 'label' => 'Max. Ac Apparent Power (VA)', 'unit' => 'VA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'nominal_output_voltage', 'label' => 'Nominal Output Voltage (V)', 'unit' => 'V', 'data_type' => 'string', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'ac_grid_frequency_range', 'label' => 'AC Grid Frequency Range (Hz)', 'unit' => 'Hz', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 6],
                    ['key' => 'max_output_current', 'label' => 'Max. Output Current', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 7],
                ]],
                ['title' => 'Protection', 'sort_order' => 3, 'fields' => [
                    ['key' => 'resicdual_current_monitoring', 'label' => 'Resicdual Current Monitoring', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 1],
                    ['key' => 'pv_reverse_polarity', 'label' => 'PV-Reverse Polarity', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'ac_overvoltage_overcurrent_short_circuit', 'label' => 'AC (Overvoltage - Overcurrent - Short Circuit)', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'dc_ac_surge_protection', 'label' => 'DC & AC Surge Preotection', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'afci_type_3_ai_driven', 'label' => 'AFCI Type 3 AI driven', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 5],
                ]],
                ['title' => 'General Specefications', 'sort_order' => 4, 'fields' => [
                    ['key' => 'max_efficiency ', 'label' => 'MAX. Efficiency (%)', 'unit' => '%', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'eu_efficiency', 'label' => 'EU Efficiency (%)', 'unit' => '%', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'ip_rating', 'label' => 'IP Rating', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'led_screen', 'label' => 'LED Screen', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'dimensions', 'label' => 'Dimensions (mm)', 'unit' => 'mm', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 5],
                ]],
            ],

            'Hybrid Inverters' => [
                ['title' => 'PV Input Specefications', 'sort_order' => 1, 'fields' => [
                    ['key' => 'max_input_voltage', 'label' => 'Max Input Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'mppt_voltage_range', 'label' => 'MPPT Voltage Range (V)', 'unit' => 'V', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'start_up_voltage', 'label' => 'Start-up Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 3],
                    ['key' => 'nominal_input_voltage', 'label' => 'Nominal Input Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_input_current_per_mppt', 'label' => 'Max Input Current Per MPPT (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'max_short_circuit_current_per_mppt', 'label' => 'Max Short Circuit Current Per MPPT (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 6],
                    ['key' => 'number_of_mpp_trackers', 'label' => 'Number of MPP Trackers', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 7],
                    ['key' => 'number_of_strings_per_mppt', 'label' => 'Number of Strings Per MPPT', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 8],
                ]],
                ['title' => 'Battery Input Specefications', 'sort_order' => 2, 'fields' => [
                    ['key' => 'number_of_battery_input', 'label' => 'Number of Battery Input', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 1],
                    ['key' => 'nominal_battery_voltage', 'label' => 'Nominal Battery Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'battery_voltage_range', 'label' => 'Battery Voltage Range (V)', 'unit' => 'V', 'data_type' => 'text', 'is_key' => true, 'sort_order' => 3],
                    ['key' => 'max_continuous_charging_current', 'label' => 'Max. Continuous Charging Current (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_continuous_discharging_current', 'label' => 'Max. Continuous Discharging Current (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'max_charging_power', 'label' => 'Max. Charging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 6],
                    ['key' => 'max_discharging_power', 'label' => 'Max. Discharging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 7],
                ]],
                ['title' => 'Grid Port Specefications', 'sort_order' => 3, 'fields' => [
                    ['key' => 'nominal_output_power', 'label' => 'Nominal Output Power (W)', 'unit' => 'W', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'nominal_output_apparent_power', 'label' => 'Nominal Output Apparent Power (VA)', 'unit' => 'VA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'max_ac_active_power', 'label' => 'Max. AC Active Power (W)', 'unit' => 'W', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'max_ac_apparent_power_to_grid', 'label' => 'Max. AC Apparent Power To Grid (VA)', 'unit' => 'VA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_ac_apparent_power_input_from_grid', 'label' => 'Max. AC Apparent Power Input From Grid (kVA)', 'unit' => 'kVA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'nominal_output_voltage', 'label' => 'Nominal Output Voltage (V)', 'unit' => 'V', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 6],
                    ['key' => 'ac_grid_frequency_range', 'label' => 'AC Grid Frequency Range (Hz)', 'unit' => 'Hz', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 7],
                    ['key' => 'max_output_current', 'label' => 'Max. Output Current', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 8],
                    ['key' => 'max_input_current', 'label' => 'Max. Input Current', 'unit' => null, 'data_type' => 'number', 'is_key' => false, 'sort_order' => 9],
                ]],
                ['title' => 'Backup Output Specefications', 'sort_order' => 4, 'fields' => [
                    ['key' => 'backup_nominal_apparent_power', 'label' => 'Back-up Nominal Apparent Power (kVA)', 'unit' => 'kVA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 1],
                    ['key' => 'max_output_apparent_power_without_grid', 'label' => 'Max. Output Apparent Power without Grid (kVA)', 'unit' => 'kVA', 'data_type' => 'text', 'is_key' => true, 'sort_order' => 2],
                    ['key' => 'max_output_apparent_power_with_grid', 'label' => 'Max. Output Apparent Power with Grid (kVA)', 'unit' => 'kVA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'nominal_output_voltage', 'label' => 'Nominal Output Voltage (V)', 'unit' => 'V', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 4],
                ]],
                ['title' => 'Generator Input Specefications', 'sort_order' => 5, 'fields' => [
                    ['key' => 'nominal_apparent_power_from_ac_generator', 'label' => 'Nominal Apparent Power from AC generator (kVA)', 'unit' => 'kVA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 1],
                    ['key' => 'max_apparent_power_from_ac_generator', 'label' => 'Max. Apparent Power from AC generator (kVA)', 'unit' => 'kVA', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'input_voltage_range', 'label' => 'Input Voltage Range (V)', 'unit' => 'V', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'max_ac_current_from_ac_generator', 'label' => 'Max. AC Current From AC generator (A)', 'unit' => 'A', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                ]],
                ['title' => 'Protection', 'sort_order' => 6, 'fields' => [
                    ['key' => 'residual_current_monitoring', 'label' => 'Residual Current Monitoring ', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 1],
                    ['key' => 'pv_reverse_polarity', 'label' => 'PV Reverse Polarity', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'ac_overvoltage_overcurrent_short_circuit', 'label' => 'AC (Overvoltage - Overcurrent - Short Circuit)', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'dc_ac_surge_protection', 'label' => 'DC & AC Surge Protection', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'afci_type_3_ai_driven', 'label' => 'AFCI Type 3 AI Driven', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 5],
                ]],
                ['title' => 'General Specefications', 'sort_order' => 7, 'fields' => [
                    ['key' => 'max_efficiency', 'label' => 'Max. Efficiency (%)', 'unit' => '%', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'eu_efficiency', 'label' => 'EU Efficiency', 'unit' => '%', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'ip_rating', 'label' => 'IP Rating', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 3],
                    ['key' => 'led_screen', 'label' => 'LED Screen', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'dimensions', 'label' => 'Dimensions (mm)', 'unit' => 'mm', 'data_type' => 'text', 'is_key' => false, 'sort_order' => 5],
                ]],
            ],

            'LV Batteries' => [
                ['title' => 'General Specefications', 'sort_order' => 1, 'fields' => [
                    ['key' => 'rated_energy', 'label' => 'Rated Energy (kWh)', 'unit' => 'kWh', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'usable_energy', 'label' => 'Usable Energy (kWh)', 'unit' => 'kWh', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'nominal_voltage', 'label' => 'Nominal Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 3],
                    ['key' => 'max_continuous_charging_power', 'label' => 'Max. Continuous Charging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_continuous_discharging_power', 'label' => 'Max. Continuous Discharging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'peak_output_power', 'label' => 'Peak Output Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 6],
                    ['key' => 'cycle_lifespan', 'label' => 'Cycle Lifespan', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 7],
                    ['key' => 'ip_rating', 'label' => 'IP Rating', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 8],
                    ['key' => 'round_trip_efficiency', 'label' => 'Round Trip Efficiency', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 9],
                    ['key' => 'depth_of_discharge', 'label' => 'Depth of Discharge', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 10],
                ]],
            ],

            'HV Batteries' => [
                ['title' => 'General Specefications', 'sort_order' => 1, 'fields' => [
                    ['key' => 'rated_energy', 'label' => 'Rated Energy (kWh)', 'unit' => 'kWh', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'usable_energy', 'label' => 'Usable Energy (kWh)', 'unit' => 'kWh', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'nominal_voltage', 'label' => 'Nominal Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 3],
                    ['key' => 'max_continuous_charging_power', 'label' => 'Max. Continuous Charging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_continuous_discharging_power', 'label' => 'Max. Continuous Discharging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'peak_output_power', 'label' => 'Peak Output Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 6],
                    ['key' => 'cycle_lifespan', 'label' => 'Cycle Lifespan', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 7],
                    ['key' => 'ip_rating', 'label' => 'IP Rating', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 8],
                    ['key' => 'round_trip_efficiency', 'label' => 'Round Trip Efficiency', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 9],
                    ['key' => 'depth_of_discharge', 'label' => 'Depth of Discharge', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 10],
                ]],
            ],

            'All in one' => [
                ['title' => 'General Specefications', 'sort_order' => 1, 'fields' => [
                    ['key' => 'rated_energy', 'label' => 'Rated Energy (kWh)', 'unit' => 'kWh', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 1],
                    ['key' => 'usable_energy', 'label' => 'Usable Energy (kWh)', 'unit' => 'kWh', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 2],
                    ['key' => 'nominal_voltage', 'label' => 'Nominal Voltage (V)', 'unit' => 'V', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 3],
                    ['key' => 'max_continuous_charging_power', 'label' => 'Max. Continuous Charging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 4],
                    ['key' => 'max_continuous_discharging_power', 'label' => 'Max. Continuous Discharging Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => false, 'sort_order' => 5],
                    ['key' => 'peak_output_power', 'label' => 'Peak Output Power (kW)', 'unit' => 'kW', 'data_type' => 'number', 'is_key' => true, 'sort_order' => 6],
                    ['key' => 'cycle_lifespan', 'label' => 'Cycle Lifespan', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 7],
                    ['key' => 'ip_rating', 'label' => 'IP Rating', 'unit' => null, 'data_type' => 'text', 'is_key' => false, 'sort_order' => 8],
                    ['key' => 'round_trip_efficiency', 'label' => 'Round Trip Efficiency', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 9],
                    ['key' => 'depth_of_discharge', 'label' => 'Depth of Discharge', 'unit' => null, 'data_type' => 'text', 'is_key' => true, 'sort_order' => 10],
                ]],
            ],
        ];

        DB::transaction(function () use ($templates) {

            foreach ($templates as $subcategoryName => $groups) {
                $subcategory = Subcategory::where('name', $subcategoryName)->firstOrFail();

                foreach ($groups as $groupData) {
                    $group = SpecGroup::updateOrCreate(
                        [
                            'subcategory_id' => $subcategory->id,
                            'title' => $groupData['title'],
                        ],
                        [
                            'sort_order' => $groupData['sort_order'],
                        ]
                    );

                    foreach ($groupData['fields'] as $fieldData) {
                        SpecField::updateOrCreate(
                            [
                                'subcategory_id' => $subcategory->id,
                                'key' => $fieldData['key'],
                            ],
                            [
                                'group_id' => $group->id,
                                'label' => $fieldData['label'],
                                'unit' => $fieldData['unit'],
                                'data_type' => $fieldData['data_type'],
                                'is_key' => $fieldData['is_key'],
                                'sort_order' => $fieldData['sort_order'],
                                'status' => 'active',
                            ]
                        );
                    }
                }
            }
        });
    }
}
