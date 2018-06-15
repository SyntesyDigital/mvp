# About Architect 2.0

## Custom Fields Types

- Text
- Richtext
- Image
- Date
- Boolean
- Link
- Video
- List
- Images
- Contents

## Custom Fields Configuration

### Rules

- required
- unique
- minCharacters
- maxCharacters
- maxItems
- minItems

### Settings

- fieldHeight
- typologiesAllowed
- cropsAllowed
- listAllowed


### Laravel => React Content fields JSON format
[

// TEXT
{
    type : 'text',
    identifier : 'mytext',
    values : {
        cat : '...',
        es : '...',
        fr : '...'
    }
},

// RICHTEXT
{
    type : 'richtext',
    identifier : 'myrichtext',
    values : {
        cat : '...',
        es : '...',
        fr : '...'
    }
},


// IMAGE
{
    type : 'image',
    identifier : 'myimage',
    values : (Media Object) {
        id : '..',
        storage_path : '...',
        urls : '...'
    }
},

// IMAGES
{
    type : 'image',
    identifier : 'myimage',
    values : [(Media Object), (Media Object), (Media Object)]
},

// CONTENTS
{
    type : 'contents',
    identifier : 'mycontents',
    values : [(Content Object), (Content Object), (Content Object)]
},

// BOOLEAN
{
    type : 'boolean',
    identifier : 'myboolean',
    values : true || false
},

// DATE
{
    type : 'date',
    identifier : 'mydate',
    values : timestamp
},

// LINKS
{
    type : 'link',
    identifier : 'mylinks',
    values : URL
},

// LOCALIZATION
{
    type : 'localization',
    identifier : 'mylocalization',
    values : {....}
},


// VIDEO
{
    type : 'video',
    identifier : 'myvideo',
    values : '...'
}

]
