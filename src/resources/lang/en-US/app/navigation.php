<?php
    return [
        'routes' => [
            'home' => trans('sourceblock::App/titles.general.home'),

            'guides' => trans('sourceblock::App/titles.general.guides'),
            'guides:fundamentals' => trans('sourceblock::App/titles.guides.fundamentals'),
            'guides:fundamentals/data-packs' => trans('sourceblock::App/titles.minecraft.data-packs'),

            // Data schemas

            'guides:fundamentals/data-packs/data-schemas' => trans('sourceblock::App/titles.minecraft.data-schemas.meta.title'),
            'guides:fundamentals/data-packs/data-schemas/schemas' => 'JSON',

            // Advancements

            'guides:fundamentals/data-packs/advancements' => trans('sourceblock::App/titles.minecraft.advancements'),
            'guides:fundamentals/data-packs/advancements/customization' => 'Customization',
            'guides:fundamentals/data-packs/advancements/triggers' => 'Triggers',
            'guides:fundamentals/data-packs/advancements/conclusion' => 'Conclusion',

            // Tools

            'tools' => trans('sourceblock::App/titles.general.tools'),
            'tools:data-packs' => trans('sourceblock::App/titles.minecraft.data-packs'),
            'tools:resource-packs' => trans('sourceblock::App/titles.minecraft.resource-packs'),
            'tools:featured' => trans('sourceblock::App/titles.general.featured'),
            'tools:other' => trans('sourceblock::App/titles.general.other'),
            'tools:data-packs/advancement-evaluator' => trans('sourceblock::App/titles.tools.advancement-evaluator'),
            'tools:data-packs/recipe-evaluator' => trans('sourceblock::App/titles.tools.recipe-evaluator'),
            'tools:data-packs/text-component-evaluator' => trans('sourceblock::App/titles.tools.text-component-evaluator'),
            'tools:data-packs/loot-table-evaluator' => trans('sourceblock::App/titles.tools.loot-table-evaluator'),
            'tools:data-packs/packmcmeta-evaluator' => trans('sourceblock::App/titles.tools.packmcmeta-evaluator'),
            'tools:data-packs/tag-evaluator' => trans('sourceblock::App/titles.tools.tag-evaluator'),
        ]
    ];
