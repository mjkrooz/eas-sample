@extends('sourceblock::layouts.guides.fundamentals.advancements', ['toc_float' => true])

@section('guide-navigation-toc')
    @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
        'Criteria',
        'Requirements',
        'Rewards',
        [
            'Recipes',
            'Loot',
            'Experience',
            'Function'
        ],
        'Display',
        [
            'Title',
            'Description',
            'Icon',
            'Background',
            'Frame',
            'Show toast',
            'Announce to chat',
            'Hidden',
        ],
        'Advancement tree',
        [
            'Root',
            'Branches'
        ]
    ]])
@endsection

@section('guide')
    {{-- CRITERIA --}}

    <h2 id="sec-criteria">Criteria</h2>
    <hr>

    <p>The only necessity of a custom advancement is to have a set of criteria. These are events to detect through the use of <a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}">triggers</a>. You can have as many as you want, as long as you have at least one.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:bred_animals"
        },
        "take_damage": {
            "trigger": "minecraft:entity_hurt_player"
        }
    }
}'])

    <p>Within the <code>criteria</code> object are where each criterion is specified. The name of each criterion object can be anything (in this example, "custom_test_name" and "take_damage") as long as they are unique in the same advancement. The trigger itself is specified with the <code>trigger</code> string.</p>

    <div class="card bg-light text-dark shadow-sm my-4">
        <div class="card-body">
            <div class="card-text">
                <div class="row">
                    <div class="col-2 text-center d-flex justify-content-center align-items-center"><i class="fas fa-exclamation-circle fa-4x text-danger"></i></div>
                    <div class="col-10">
                        <p class="lead">The following is incorrect due to using the same criterion name twice.</p>
                        <p class="lead font-weight-bold text-center"><a href="#badExample1" data-toggle="collapse" class="btn btn-secondary btn-block">View improper example <i class="fas fa-chevron-down"></i></a></p>
                        <div id="badExample1" class="collapse">
                            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "the_name": {
            "trigger": "minecraft:brewed_potion"
        },
        "the_name": {
            "trigger": "minecraft:placed_block"
        }
    }
}'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REQUIREMENTS --}}

    <div class="clearfix"></div>

    <h2 id="sec-requirements">Requirements<span class="float-right"><a href="#sec-criteria" data-toggle="tooltip" title="go to top"><i class="fas fa-arrow-circle-up"></i></a></span></h2>
    <div class="clearfix"></div>
    <hr>

    <p>By default, all criteria in an advancement have to be completed before the advancement is granted to the player.</p>

    <p>This can be changed by making use of the <code>requirements</code> list. Each element inside it is another list, which then specifies the names you've given to the criteria. Each individual list of criteria names only requires one of those specified criteria to be completed. This is known as <a href="https://en.wikipedia.org/wiki/Conjunctive_normal_form" target="_blank">conjuctive normal form</a>.</p>

    <p>For example, the following will require either "criteria_A" <b>or</b> "criteria_B" to be completed to fulfill the advancement. Thus if the player completes "criteria_A" but not "criteria_B", they will still be granted the achievement.</p>

    <div class="row mb-4">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="w-100">
                @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "criteria_A": {
            "trigger": "minecraft:bred_animals"
        },
        "criteria_B": {
            "trigger": "minecraft:entity_hurt_player"
        }
    },
    "requirements": [
        [
            "criteria_A",
            "criteria_B"
        ]
    ]
}'])
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light text-dark shadow-sm">
                <div class="card-body">
                    <div class="card-text">
                        <div class="row">
                            <div class="col-2 text-center d-flex justify-content-center align-items-center"><i class="fas fa-exclamation-circle fa-4x text-danger"></i></div>
                            <div class="col-10">
                                <p class="lead">The following is incorrect because not all criteria were specified in <span class="text-monospace">requirements</span>.</p>
                                <p class="lead font-weight-bold text-center"><a href="#badExample2" data-toggle="collapse" class="btn btn-secondary btn-block">View improper example <i class="fas fa-chevron-down"></i></a></p>
                                <div id="badExample2" class="collapse">
                                    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "criteria_A": {
            "trigger": "minecraft:brewed_potion"
        },
        "criteria_B": {
            "trigger": "minecraft:placed_block"
        },
        "criteria_C": {
            "trigger": "minecraft:used_ender_eye"
        }
    },
    "requirements": [
        [
            "criteria_A",
            "criteria_B"
        ]
    ]
}'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p>This means that each individual list of criteria names you specify requires the player to complete at least one from each list.</p>

    <p>For example, the following requires the player to complete both "criteria_A" <b>and</b> "criteria_B". Note that with this example, this is the same as not specifying requirements.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "criteria_A": {
            "trigger": "minecraft:bred_animals"
        },
        "criteria_B": {
            "trigger": "minecraft:entity_hurt_player"
        }
    },
    "requirements": [
        [
            "criteria_A"
        ],
        [
            "criteria_B"
        ]
    ]
}'])

    <p>While the following will require either "criteria_A" <b>or</b> "criteria_B", <b>and</b> "criteria_C".</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "criteria_A": {
            "trigger": "minecraft:bred_animals"
        },
        "criteria_B": {
            "trigger": "minecraft:entity_hurt_player"
        },
        "criteria_B": {
            "trigger": "minecraft:target_hit"
        }
    },
    "requirements": [
        [
            "criteria_A",
            "criteria_B"
        ],
        [
            "criteria_C"
        ]
    ]
}'])

    <h2 id="sec-rewards" class="mt-5">Rewards<span class="float-right"><a href="#sec-criteria" data-toggle="tooltip" title="go to top"><i class="fas fa-arrow-circle-up"></i></a></span></h2>
    <div class="clearfix"></div>
    <hr>

    <div class="float-left mr-4 mb-4">
        @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
            'Recipes',
            'Loot',
            'Experience',
            'Function'
        ]])
    </div>

    <p>Once a player fufills an advancement, you can optionally give them some rewards. These rewards are specified within the <code>rewards</code> object. There are several reward types to choose from, all of which can be specified if desired.</p>

    <div class="clearfix"></div>

    <h3 id="sec-recipes">Recipes reward</h3>

    <p>The <code>recipes</code> list specifies any number of recipes that will be unlocked for the player. A list of vanilla recipe IDs can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/data/minecraft/recipes/recipes.json" target="_blank">here</a>.</p> {{-- TODO: noopener noreferrer --}}

    <p>The following awards the player with the redstone and ladder recipes once they complete the advancement.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:entity_hurt_player"
        }
    },
    "rewards": {
        "recipes": [
            "minecraft:redstone",
            "minecraft:ladder"
        ]
    }
}'])

    <h3 id="sec-loot">Loot reward</h3>

    <p>The <code>loot</code> list specifies multiple loot tables that will be used to give the player items. A list of vanilla loot table IDs can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/data/minecraft/loot_tables/loot_tables.json" target="_blank">here</a>.</p>

    <p>The following awards the player with items from the creeper and simple dungeon loot tables.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:entity_hurt_player"
        }
    },
    "rewards": {
        "loot": [
            "minecraft:entities/creeper",
            "minecraft:chests/simple_dungeon"
        ]
    }
}'])

    <h3 id="sec-experience">Experience reward</h3>

    <p>The <code>experience</code> integer states an amount of experience points (not levels) that the player will receive. The following awards the player with 500 experience points.</p>
    
    <div class="row mb-4">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="w-100">
                @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:entity_hurt_player"
        }
    },
    "rewards": {
        "experience": 500
    }
}'])
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light text-dark shadow-sm">
                <div class="card-body">
                    <div class="card-text">
                        <div class="row">
                            <div class="col-2 text-center d-flex justify-content-center align-items-center"><i class="fas fa-exclamation-circle fa-4x text-danger"></i></div>
                            <div class="col-10">
                                <p class="lead">The following is incorrect because the experience value cannot be a range.</p>
                                <p class="lead font-weight-bold text-center"><a href="#badExample3" data-toggle="collapse" class="btn btn-secondary btn-block">View improper example <i class="fas fa-chevron-down"></i></a></p>
                                <div id="badExample3" class="collapse">
                                    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "criteria_B": {
            "trigger": "minecraft:tick"
        }
    },
    "rewards": {
        "experience": {
            "min": 250,
            "max": 750
        }
    }
}'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <h3 id="sec-function">Function reward</h3>

    <p>The <code>function</code> string specifies the resource location to a function that will run (which <b>cannot</b> be a <a href="https://minecraft.gamepedia.com/Tag#Function_tags" target="_blank">function tag</a> ). The player will be used as the command sender (allowing you to use <code>@s</code> to target them in the function) and the execution position (changed by the <code>at</code> argument for <code>/execute</code>) will also be the player's position.</p>

    <p>The following will run the <code>path:to/function</code> function while using the advancement-earning player for the position and as the command sender.</p>
    
    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:entity_hurt_player"
        }
    },
    "rewards": {
        "function": "path:to/function"
    }
}'])

    <h2 id="sec-display" class="mt-5">Display<span class="float-right"><a href="#sec-criteria" data-toggle="tooltip" title="go to top"><i class="fas fa-arrow-circle-up"></i></a></span></h2>
    <div class="clearfix"></div>
    <hr>

    <div class="float-left mr-4 mb-4">
        @include('sourceblock::chunks.menus.guides.fundamentals.toc', ['menu' => [
            'Title',
            'Description',
            'Icon',
            'Background',
            'Frame',
            'Show toast',
            'Announce to chat',
            'Hidden'
        ]])
    </div>
    

    <p>All of the examples so far have been for advancements that do not appear to the player. If you want to use an advancement as an actual progress indicator rather than as a hidden event listener, you will have to give it a display.</p>

    <p>At minimum, the <code>display</code> object must contain a <a href="#sec-title">title</a>, <a href="#sec-description">description</a>, and <a href="#sec-icon">icon</a>.</p>
    
    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Advancement title",
        "description": "The description of the advancement",
        "icon": {
            "item": "minecraft:elytra"
        }
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:impossible"
        }
    }
}'])

    <div class="clearfix"></div>

    <h3 id="sec-title">Title</h3>

    <p>The <code>title</code> field is a <a href="{{ route('guides:fundamentals/text-components') }}">text component</a> that specifies the title as seen in the advancements menu when hovering over the icon with the mouse. It also appears in the toast given to the player, if the <a href="#sec-show-toast">toast is enabled</a> for the advancement.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-title.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Stew",
        "description": "",
        "icon": {
            "item": "minecraft:mushroom_stew"
        },
        "background": "minecraft:textures/gui/advancements/backgrounds/stone.png"
    },
    "criteria": {
        "trigger_1": {
            "trigger": "minecraft:location"
        }
    }
}'])
        </div>
    </div>

    <p>As the title is a text component, various formatting options can be applied. Features other than formatting, such as hover and click events, are not available.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-title-formatted.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": {
            "text":"Stew",
            "obfuscated":true
        },
        "description": "",
        "icon": {
            "item": "minecraft:mushroom_stew"
        },
        "background": "minecraft:textures/gui/advancements/backgrounds/stone.png"
    },
    "criteria": {
        "trigger_1": {
            "trigger": "minecraft:location"
        }
    }
}'])
        </div>
    </div>


    <h3 id="sec-description">Description</h3>

    <p>Like the title, the <code>description</code> field is a <a href="{{ route('guides:fundamentals/text-components') }}">text component</a> that will appear in the advancements menu. However, it will <b>not</b> appear in the toast. While the description field must be specified, it can be a blank string.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-description.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Learn to Fly",
        "description": "Learn how to fly using a new pair of elytra.",
        "icon": {
            "item": "minecraft:elytra"
        },
        "background": "minecraft:textures/gui/advancements/backgrounds/stone.png"
    },
    "criteria": {
        "elytra": {
            "trigger": "minecraft:inventory_changed",
            "conditions": {
                "items": [
                    {
                        "item": "minecraft:elytra",
                        "durability": 431
                    }
                ]
            }
        }
    }
}'])
        </div>
    </div>

    <p>Limited formatting options are also available. Non-formatting options, such as hover and click events, are not available. Colors for the description are also overwritten in favor of <a href="#sec-frame">frames</a>.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-description-formatted.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Learn to Fly",
        "description": {
            "text":"Learn how to fly using a new pair of elytra.",
            "italic":true
        },
        "icon": {
            "item": "minecraft:elytra"
        },
        "background": "minecraft:textures/gui/advancements/backgrounds/stone.png"
    },
    "criteria": {
        "elytra": {
            "trigger": "minecraft:inventory_changed",
            "conditions": {
                "items": [
                    {
                        "item": "minecraft:elytra",
                        "durability": 431
                    }
                ]
            }
        }
    }
}'])
        </div>
    </div>

    <h3 id="sec-icon">Icon</h3>

    <p>The <code>icon</code> object details the item that appears in the advancements menu as well as the toast (<a href="#sec-show-toast">if enabled</a>).</p>

    <p>Within it is a <b>required</b> <code>item</code> string that specifies the item ID of the item to show as the icon. A list of valid item IDs can be found <a href="https://github.com/Arcensoth/mcdata/blob/master/processed/reports/registries/item/item.json" target="_blank">here</a>.</p>

    <p>The optional <code>nbt</code> string specifies NBT data for the item. Note that there are very few tags that can be specified to change the display.</p>

    <p>The following sets the icon to a stick that is enchanted.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-icon.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Advancement title",
        "description": "The description of the advancement",
        "icon": {
            "item": "minecraft:stick",
            "nbt": "{Enchantments:[{id:\"minecraft:sharpness\",level:1}]}"
        },
        "background": "minecraft:textures/gui/advancements/backgrounds/stone.png"
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:impossible"
        }
    }
}'])
        </div>
    </div>

    <h3 id="sec-background">Background</h3>

    <p>An advancement can optionally have a custom background, but only if it is the <a href="#sec-root">root</a> of the advancement tree. The background is shown in the advancement menu behind the entire tree.</p>

    <p>The value of the <code>background</code> string is a resource location to any texture within a resource pack.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-background.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Stew",
        "description": "",
        "icon": {
            "item": "minecraft:mushroom_stew"
        },
        "background": "minecraft:textures/block/gold_block.png"
    },
    "criteria": {
        "trigger_1": {
            "trigger": "minecraft:location"
        }
    }
}'])
        </div>
    </div>

    <h3 id="sec-frame">Frame</h3>

    <p>The frame around the icon can be changed from its default of "task". The other options available are specified in the <code>frame</code> string. Available options are: "task", "goal", and "challenge".</p>

    <p>Frames also determine the default color of the description. "task" and "goal" both default to green, while "challenge" defaults to dark purple. These colors cannot be changed.</p>

    

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-frame-task.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Diamond block",
        "description": "Diamond block",
        "icon": {
            "item": "minecraft:diamond_block"
        },
        "background": "minecraft:textures/block/diamond_block.png",
        "frame": "task"
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:location"
        }
    }
}'])
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-frame-goal.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Diamond block",
        "description": "Diamond block",
        "icon": {
            "item": "minecraft:diamond_block"
        },
        "background": "minecraft:textures/block/diamond_block.png",
        "frame": "goal"
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:location"
        }
    }
}'])
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/display-frame-challenge.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Diamond block",
        "description": "Diamond block",
        "icon": {
            "item": "minecraft:diamond_block"
        },
        "background": "minecraft:textures/block/diamond_block.png",
        "frame": "challenge"
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:location"
        }
    }
}'])
        </div>
    </div>

    <h3 id="sec-show-toast">Show toast</h3>

    <p>By default, when the player completes an advancement, a toast is shown in the top-right of the screen with the title and icon.</p>

    <img src="{{ image_asset("guides/data-packs/advancements/toast.png") }}" class="d-block mx-auto my-4">

    <p>This can be disabled by setting the <code>show_toast</code> boolean to false.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Diamond block",
        "description": "Diamond block",
        "icon": {
            "item": "minecraft:diamond_block"
        },
        "background": "minecraft:textures/block/diamond_block.png",
        "show_toast": false
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:location"
        }
    }
}'])

    <h3 id="sec-announce-to-chat">Announce to chat</h3>

    <p>By default, when the player completes an advancement, their success is announced in the chat for all to see.</p>

    <img src="{{ image_asset("guides/data-packs/advancements/chat.png") }}" class="d-block mx-auto my-4 bg-dark p-3 rounded shadow">

    <p>This can be disabled by setting the <code>announce_to_chat</code> boolean to false.</p>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Diamond block",
        "description": "Diamond block",
        "icon": {
            "item": "minecraft:diamond_block"
        },
        "background": "minecraft:textures/block/diamond_block.png",
        "announce_to_chat": false
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:location"
        }
    }
}'])

    <h3 id="sec-hidden">Hidden</h3>

    <p>By default, you can see all advancements in an advancement tree (provided you've completed an advancement at least 2 branches away), including ones you have not completed.</p>

    <p>However, by setting the <code>hidden</code> boolean to true, the advancement will <b>only</b> display in the advancements menu once the player completes the advancement. An example of this is the Nether advancement tree, where the "How Did We Get Here?" advancement is hidden and thus can only be seen after completing it.</p>

    <div class="row mb-4">
        <div class="col-md-6">
            <img src="{{ image_asset("guides/data-packs/advancements/display-hidden-before.png") }}" class="w-100 rounded shadow">
        </div>
        <div class="col-md-6">
            <img src="{{ image_asset("guides/data-packs/advancements/display-hidden-after.png") }}" class="w-100 rounded shadow">
        </div>
    </div>

    @include('sourceblock::chunks.json-code-block', ['code' => '{
        "display": {
            "title": "Diamond block",
            "description": "Diamond block",
            "icon": {
                "item": "minecraft:diamond_block"
            },
            "background": "minecraft:textures/block/diamond_block.png",
            "hidden": true
        },
        "criteria": {
            "custom_test_name": {
                "trigger": "minecraft:location"
            }
        }
    }'])

    <h2 id="sec-advancement-tree" class="mt-5">Advancement tree<span class="float-right"><a href="#sec-criteria" data-toggle="tooltip" title="go to top"><i class="fas fa-arrow-circle-up"></i></a></span></h2>
    <div class="clearfix"></div>
    <hr>

    <p>Advancements can be arranged as a tree in the advancements menu. While the player does not have to complete each advancement in the order shown in the tree, it helps serve as a guide to discover the game's features sequentially.</p>

    <h3 id="sec-root">Root</h3>

    <p>The root is the starting point of a tree. When an advancement has a <a href="#sec-display">display</a>, it will be considered a root as long as it isn't also a <a href="#sec-branches">branch</a>.</p>

    <p>It will receive a new tab in the advancements menu that uses its icon. The root also controls the background of the new tab.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/tree.png") }}" class="w-100">
        </div>
        <div class="col-md-7">
            <code>path:to/root</code>
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "display": {
        "title": "Advancement title",
        "description": "Advancement description",
        "icon": {
            "item": "minecraft:honeycomb"
        },
        "background": "minecraft:textures/block/white_wool.png"
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:impossible"
        }
    }
'])
        </div>
    </div>

    <div class="card bg-light text-dark shadow-sm my-4">
        <div class="card-body">
            <div class="card-text">
                <div class="row">
                    <div class="col-2 text-center d-flex justify-content-center align-items-center"><i class="fas fa-info-circle fa-4x text-success"></i></div>
                    <div class="col-10">
                        <p class="mb-0 leadd font-weight-normal">If a root does not have a display, it will not have a tab in the advancements menu. However, if its branches have displays, the toast notification will still be shown. This means you can create custom toast notifications without having to have any tree display in the advancements menu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 id="sec-branches">Branches</h3>

    <p>An advancement is a branch or child if it has the <code>parent</code> string that points to another advancement. In this example, the <a href="#sec-root">root</a> has a resource location of <code>path:to/root</code>, which is specified as the parent of the advancement. This means that this advancement is a branch.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/tree-branch.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            <code>path:to/child</code>
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "parent": "path:to/root",
    "display": {
        "title": "Advancement title",
        "description": "Advancement description",
        "icon": {
            "item": "minecraft:music_disc_cat"
        }
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:impossible"
        }
    }
'])
        </div>
    </div>

    <p>An advancement can have another branch as its parent, nesting it even further.</p>

    <div class="row mb-4">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ image_asset("guides/data-packs/advancements/tree-branch-nested.png") }}" class="w-100 shadow rounded">
        </div>
        <div class="col-md-7">
            <code>path:to/grandchild</code>
            @include('sourceblock::chunks.json-code-block', ['code' => '{
    "parent": "path:to/child",
    "display": {
        "title": "Advancement title",
        "description": "Advancement description",
        "icon": {
            "item": "minecraft:music_disc_far"
        }
    },
    "criteria": {
        "custom_test_name": {
            "trigger": "minecraft:impossible"
        }
    }
'])
        </div>
    </div>
@endsection