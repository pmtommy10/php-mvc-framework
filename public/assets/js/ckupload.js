class MyUploadAdapter {
    constructor( loader ) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        xhr.open( 'POST', 'Admin/action.php?action=CKimgUpload', true );
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            if ( !response || !response.success ) {
                return reject( response && !response.success ? response.text : genericErrorText );
            }

            resolve( {
                default: response.url
            } );
        } );

        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest( file ) {
        const data = new FormData();
        data.append( 'upload', file );
        this.xhr.send( data );
    }
}

function MyCustomUploadAdapterPlugin ( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        return new MyUploadAdapter( loader );
    };
}

async function createEditor() {
    const tables = [];
    document.querySelectorAll( '.ckeditor:not([style="display: none;"])' ).forEach(async (element) => {
        await ClassicEditor
            .create( element , {
                extraPlugins: [ MyCustomUploadAdapterPlugin ],
                toolbar: [
                    'heading',
                    '|',
                    'fontFamily',
                    'fontColor',
                    'fontSize',
                    'bold',
                    'italic',
                    'underline',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',

                    'horizontalLine',
                    '|',
                    
                    'alignment',
                    'indent',
                    'outdent',
                    '|',

                    // 'ckfinder',
                    'imageUpload',
                    // 'imageTextAlternative',
                    'imageStyle',
                    'blockQuote',
                    'insertTable',
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells',
                    'mediaEmbed',
                    'undo',
                    'redo',
                    '|',

                    // 'code',
                    // 'codeBlock',
                    // '|',
    
                    'exportPdf'
                ]
            }).then(editor => {
                tables.push(editor);
            //     console.log( Array.from( editor.ui.componentFactory.names() ) );
            })
            .catch( error => {
                console.error( error );
            } );
    });
    return tables;
}
