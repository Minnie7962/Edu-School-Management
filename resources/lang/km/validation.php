<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute ត្រូវតែទទួលយក។',
    'accepted_if' => ':attribute ត្រូវតែទទួលយកនៅពេល :other គឺ :value។',
    'active_url' => ':attribute មិនមែនជា URL ត្រឹមត្រូវទេ។',
    'after' => ':attribute ត្រូវតែជាកាលបរិច្ឆេទបន្ទាប់ពី :date។',
    'after_or_equal' => ':attribute ត្រូវតែជាកាលបរិច្ឆេទបន្ទាប់ ឬស្មើនឹង :date។',
    'alpha' => ':attribute អាចមានតែអក្សរប៉ុណ្ណោះ។',
    'alpha_dash' => ':attribute អាចមានតែអក្សរ លេខ និងសញ្ញា - និង _។',
    'alpha_num' => ':attribute អាចមានតែអក្សរ និងលេខប៉ុណ្ណោះ។',
    'array' => ':attribute ត្រូវតែជា array។',
    'before' => ':attribute ត្រូវតែជាកាលបរិច្ឆេទមុន :date។',
    'before_or_equal' => ':attribute ត្រូវតែជាកាលបរិច្ឆេទមុន ឬស្មើនឹង :date។',
    'between' => [
        'numeric' => ':attribute ត្រូវតែនៅចន្លោះ :min ដល់ :max។',
        'file' => ':attribute ត្រូវតែចន្លោះ :min ដល់ :max គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែចន្លោះ :min ដល់ :max តួអក្សរ។',
        'array' => ':attribute ត្រូវតែមានចន្លោះ :min ដល់ :max ធាតុ។',
    ],
    'boolean' => 'វាល :attribute ត្រូវតែពិត ឬមិនពិត។',
    'confirmed' => 'ការបញ្ជាក់ :attribute មិនត្រូវគ្នាទេ។',
    'current_password' => 'ពាក្យសម្ងាត់មិនត្រឹមត្រូវ។',
    'date' => ':attribute មិនមែនជាកាលបរិច្ឆេទត្រឹមត្រូវទេ។',
    'date_equals' => ':attribute ត្រូវតែជាកាលបរិច្ឆេទស្មើនឹង :date។',
    'date_format' => ':attribute មិនត្រូវនឹងទំរង់ :format។',
    'different' => ':attribute និង :other ត្រូវតែខុសគ្នា។',
    'digits' => ':attribute ត្រូវតែមាន :digits ខ្ទង់។',
    'digits_between' => ':attribute ត្រូវតែមានចន្លោះ :min និង :max ខ្ទង់។',
    'dimensions' => ':attribute មានវិមាត្ររូបភាពមិនត្រឹមត្រូវ។',
    'distinct' => 'វាល :attribute មានតម្លៃស្ទួន។',
    'email' => ':attribute ត្រូវតែជាអាសយដ្ឋានអ៊ីមែលត្រឹមត្រូវ។',
    'ends_with' => ':attribute ត្រូវតែបញ្ចប់ដោយមួយក្នុងចំណោម៖ :values។',
    'exists' => ':attribute បានជ្រើសរើសមិនត្រឹមត្រូវ។',
    'file' => ':attribute ត្រូវតែជាឯកសារ។',
    'filled' => 'វាល :attribute ត្រូវតែមានតម្លៃ។',
    'gt' => [
        'numeric' => ':attribute ត្រូវតែធំជាង :value។',
        'file' => ':attribute ត្រូវតែធំជាង :value គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែធំជាង :value តួអក្សរ។',
        'array' => ':attribute ត្រូវតែមានច្រើនជាង :value ធាតុ។',
    ],
    'gte' => [
        'numeric' => ':attribute ត្រូវតែធំជាង ឬស្មើនឹង :value។',
        'file' => ':attribute ត្រូវតែធំជាង ឬស្មើនឹង :value គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែធំជាង ឬស្មើនឹង :value តួអក្សរ។',
        'array' => ':attribute ត្រូវតែមាន :value ធាតុឬច្រើនជាងនេះ។',
    ],
    'image' => ':attribute ត្រូវតែជា​រូបភាព។',
    'in' => ':attribute ដែលបានជ្រើសរើសមិនត្រឹមត្រូវ។',
    'in_array' => 'វាល :attribute មិនមាននៅក្នុង :other។',
    'integer' => ':attribute ត្រូវតែជាចំនួនគត់។',
    'ip' => ':attribute ត្រូវតែជា​អាសយដ្ឋាន IP ត្រឹមត្រូវ។',
    'ipv4' => ':attribute ត្រូវតែជា​អាសយដ្ឋាន IPv4 ត្រឹមត្រូវ។',
    'ipv6' => ':attribute ត្រូវតែជា​អាសយដ្ឋាន IPv6 ត្រឹមត្រូវ។',
    'json' => ':attribute ត្រូវតែជា JSON ត្រឹមត្រូវ។',
    'lt' => [
        'numeric' => ':attribute ត្រូវតែតូចជាង :value។',
        'file' => ':attribute ត្រូវតែតូចជាង :value គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែតូចជាង :value តួអក្សរ។',
        'array' => ':attribute ត្រូវតែមានតិចជាង :value ធាតុ។',
    ],
    'lte' => [
        'numeric' => ':attribute ត្រូវតែតូចជាង ឬស្មើនឹង :value។',
        'file' => ':attribute ត្រូវតែតូចជាង ឬស្មើនឹង :value គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែតូចជាង ឬស្មើនឹង :value តួអក្សរ។',
        'array' => ':attribute មិនត្រូវមានច្រើនជាង :value ធាតុទេ។',
    ],
    'max' => [
        'numeric' => ':attribute មិនត្រូវធំជាង :max។',
        'file' => ':attribute មិនត្រូវធំជាង :max គីឡូបៃ។',
        'string' => ':attribute មិនត្រូវធំជាង :max តួអក្សរ។',
        'array' => ':attribute មិនត្រូវមានច្រើនជាង :max ធាតុទេ។',
    ],
    'mimes' => ':attribute ត្រូវតែជាឯកសារប្រភេទ៖ :values។',
    'mimetypes' => ':attribute ត្រូវតែជាឯកសារប្រភេទ៖ :values។',
    'min' => [
        'numeric' => ':attribute ត្រូវតែយ៉ាងហោចណាស់ :min។',
        'file' => ':attribute ត្រូវតែយ៉ាងហោចណាស់ :min គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែយ៉ាងហោចណាស់ :min តួអក្សរ។',
        'array' => ':attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min ធាតុ។',
    ],
    'multiple_of' => ':attribute ត្រូវតែជា​ចំនួនចែកដាច់នឹង :value។',
    'not_in' => ':attribute ដែលបានជ្រើសរើសមិនត្រឹមត្រូវ។',
    'not_regex' => ':attribute ទ្រង់ទ្រាយមិនត្រឹមត្រូវ។',
    'numeric' => ':attribute ត្រូវតែជាលេខ។',
    'password' => 'ពាក្យសម្ងាត់មិនត្រឹមត្រូវ។',
    'present' => 'វាល :attribute ត្រូវតែមាន។',
    'regex' => ':attribute ទ្រង់ទ្រាយមិនត្រឹមត្រូវ។',
    'required' => 'ត្រូវការ :attribute។',
    'required_if' => 'វាល :attribute ត្រូវបានទាមទារនៅពេល :other គឺ :value។',
    'required_unless' => 'វាល :attribute ត្រូវបានទាមទារលុះត្រាតែ :other នៅក្នុង :values។',
    'required_with' => 'វាល :attribute ត្រូវបានទាមទារនៅពេល :values មាន។',
    'required_with_all' => 'វាល :attribute ត្រូវបានទាមទារនៅពេល :values មាន។',
    'required_without' => 'វាល :attribute ត្រូវបានទាមទារនៅពេល :values មិនមាន។',
    'required_without_all' => 'វាល :attribute ត្រូវបានទាមទារនៅពេលគ្មានអ្វីក្នុងចំណោម :values មាន។',
    'prohibited' => 'វាល :attribute ត្រូវបានហាមឃាត់។',
    'prohibited_if' => 'វាល :attribute ត្រូវបានហាមឃាត់នៅពេល :other គឺ :value។',
    'prohibited_unless' => 'វាល :attribute ត្រូវបានហាមឃាត់លុះត្រាតែ :other នៅក្នុង :values។',
    'same' => ':attribute និង :other ត្រូវតែដូចគ្នា។',
    'size' => [
        'numeric' => ':attribute ត្រូវតែមានទំហំ :size។',
        'file' => ':attribute ត្រូវតែមានទំហំ :size គីឡូបៃ។',
        'string' => ':attribute ត្រូវតែមាន :size តួអក្សរ។',
        'array' => ':attribute ត្រូវតែមាន :size ធាតុ។',
    ],
    'starts_with' => ':attribute ត្រូវតែចាប់ផ្ដើមដោយមួយក្នុងចំណោម៖ :values។',
    'string' => ':attribute ត្រូវតែជាអក្សរ។',
    'timezone' => ':attribute ត្រូវតែជាតំបន់ម៉ោងត្រឹមត្រូវ។',
    'unique' => ':attribute ត្រូវបានប្រើរួចហើយ។',
    'uploaded' => ':attribute បានបរាជ័យក្នុងការផ្ទុកឡើង។',
    'url' => ':attribute ត្រូវតែជាទ្រង់ទ្រាយ URL ត្រឹមត្រូវ។',
    'uuid' => ':attribute ត្រូវតែជាប្រភេទ UUID ត្រឹមត្រូវ។',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'សារ-ផ្ទាល់ខ្លួន',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
