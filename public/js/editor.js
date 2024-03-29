const items = []


function apiFetch(userName) {

    
   return $.get(usersListURL + userName, function( data ) {
        // JSON.parse(data).forEach(e => {
        //     resp.push(e);
        // });
        return data;
    });

}

function getFeedItems( queryText ) {

            return new Promise( resolve => {
                apiFetch(queryText).then(itemsToDisplay => {
                    // console.log({itemsToDisplay});
                    resolve( JSON.parse(itemsToDisplay) );
                })
            } );


}

var editors = {}; 


$(document).ready(function() {
    let _editors = [
        'editor_rants', 
        'editor_topics', 
        'editor_questions', 
        'editor_comments', 
        'editor'
        // document.querySelector('.editor')
    ];//document.querySelectorAll( '.editor' );


    for(let i = 0; i < _editors.length; i++) {
        ClassicEditor
        .create( document.querySelector('#'+_editors[i]), {
            
            toolbar: {
                items: [
                    // 'heading',
                    'bold',
                    'italic',
                    'underline',
                    'imageUpload',
                    '|',
                    'strikethrough',
                    'superscript',
                    'subscript',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'link',
                    'blockQuote',
                    'mediaEmbed',
                    '|',
                    'code',
                    'codeBlock',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            language: 'en',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            licenseKey: '',
            simpleUpload: {
                // The URL that the images are uploaded to.
                uploadUrl: uploadURL ? uploadURL : '/media/upload',

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
                        minimumCharacters: 2
                    }
                ]
            }
            
            
        } )
        .then( editor => {
            // console.log({editor})
            // window.editor = editor;
            editors[ _editors[i] ] = editor;

            // console.log({editor})
        } )
        .catch( error => {
            // console.error( error );
        } );
    }

});
