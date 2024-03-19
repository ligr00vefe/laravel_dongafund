class UploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file.then( file => new Promise(((resolve, reject) => {
            this._initRequest();
            this._initListeners( resolve, reject, file );
            this._sendRequest( file );
        })))
    }

    _initRequest() {
        const csrf_token = $('meta[name=csrf-token]').attr("content");
        const request_uri = window.location.pathname;
        let url = "";
        switch (request_uri)
        {
            case "/b1BjW55p/donate/program/create":
                url = "/b1BjW55p/upload/editor/donate";
                break;
            case "/b1BjW55p/contents/news/create":
                url = "/b1BjW55p/upload/editor/donate";
                break;
        }
        const xhr = this.xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader("x-csrf-token", csrf_token);
        xhr.setRequestHeader("Access-Control-Allow-Origin", '*');
        xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = '파일을 업로드 할 수 없습니다.';

        xhr.addEventListener('error', () => {reject(genericErrorText)});
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;
            // if(!response || response.error) {
            //     return reject( response && response.error ? response.error.message : genericErrorText );
            // }

            var $images = $("input[name='editor_image']");
            if ($images.val() != "") {
                $images.val($images.val() + ",");
            }
            $images.val($images.val() + response.id);

            resolve({
                default: response.url //업로드된 파일 주소
            })
        })
    }

    _sendRequest(file) {
        const data = new FormData();
        data.append('upload',file);
        this.xhr.send(data);
    }
}


function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new UploadAdapter(loader)
    }
}
