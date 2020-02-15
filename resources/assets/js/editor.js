InlineEditor
.create( document.querySelector( '.editor' ), {
    toolbar: {
        items: [
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            'alignment',
            'bulletedList',
            'numberedList',
            '|',
            'link',
            'blockQuote',
            'imageUpload',
            'mediaEmbed',
            'code',
            '|',
            'undo',
            'redo'
        ]
    },
    simpleUpload: {
        // The URL that the images are uploaded to.
        uploadUrl: '/media/upload',

        // Headers sent along with the XMLHttpRequest to the upload server.
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
    mention: {
        feeds: [
            {
                marker: '@',
                feed: getFeedItems,
                minimumCharacters: 2,
                itemRenderer: customItemRenderer

            }
        ]
    }
})
.then( editor => {
    window.editor = editor;
} )
.catch( error => {
    // console.log( error );
});



function getFeedItems( queryText ) {
return new Promise( resolve => {
    $.get('users/list/?username=' + queryText, function(data) {
        const itemsToDisplay = JSON.parse(data)
            resolve( itemsToDisplay );
    })

});
}

function customItemRenderer( item ) {
const itemElement = document.createElement( 'span' );

itemElement.classList.add( 'custom-item' );
itemElement.id = `mention-list-item-id-${ item.userId }`;
itemElement.textContent = `${ item.name } `;

const usernameElement = document.createElement( 'span' );

usernameElement.classList.add( 'custom-item-username' );
usernameElement.textContent = item.id;

itemElement.appendChild( usernameElement );

return itemElement;
}
