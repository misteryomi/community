<!-- <script src="{{ asset('assets/js/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>tinymce.init({
  selector:'#textarea',
  plugins: 'autoresize bbcode autolink code image anchor emoticons code media',
  toolbar: 'formatselect | bold italic underline strikethrough  | media alignleft aligncenter alignright alignjustify |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | emoticons | code',
  menubar: false,
  branding: false,
  height: 500
  });
</script> -->
<!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
  var quill = new Quill('#editor-container', {
    // placeholder: 'Write Something...',
    theme: 'snow',
    modules: {
      toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['image', 'code-block']
      ]
    },

  });
</script> -->

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script> -->
<script src="{{ asset('assets/js/plugins/ckeditor/build/ckeditor.js') }}"></script>

<script>

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


</script>
