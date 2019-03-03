# Expotition

PHP classes to build a Gamebook story.

[View a slideshow from a TrianglePHP Meetup](http://puritandesigns.com/expotition/) 

## Getting Started

1. Run `composer require puritandesigns/expotition`
0. Require composer's autoload and create an adventure: `$adventure = new Adventure();`
0. Create settings that have actions:
```php
$town = new Setting(
    $adventure,
    'Town',
    'You find yourself in a small town bustling with activity.',
);

$tavern = new Setting(
    $adventure,
    'Tavern',
    'You are in a single-room tavern.',
    new Actions(
        new SimpleResponseAction(
            'Talk to Bartender',
            $adventure,
            'The Bartender grunts, "Welcome to my pub."'
        ),
        new LeaveAction(
            'Head outside',
            $adventure,
            $town
        )
    )
);
```
