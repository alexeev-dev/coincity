window.$ = window.jQuery = require('jquery');

import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/modern/theme';

import 'tinymce/skins/lightgray/skin.min.css';
import 'tinymce/skins/lightgray/content.min.css';
import 'tinymce/plugins/advlist/plugin';
import 'tinymce/plugins/autolink/plugin';
import 'tinymce/plugins/lists/plugin';
import 'tinymce/plugins/link/plugin';
import 'tinymce/plugins/image/plugin';

import 'tinymce/plugins/charmap/plugin';
import 'tinymce/plugins/print/plugin';
import 'tinymce/plugins/preview/plugin';
import 'tinymce/plugins/anchor/plugin';
import 'tinymce/plugins/textcolor/plugin';

import 'tinymce/plugins/searchreplace/plugin';
import 'tinymce/plugins/visualblocks/plugin';
import 'tinymce/plugins/code/plugin';
import 'tinymce/plugins/fullscreen/plugin';

import 'tinymce/plugins/insertdatetime/plugin';
import 'tinymce/plugins/media/plugin';
import 'tinymce/plugins/table/plugin';
import 'tinymce/plugins/paste/plugin';
import 'tinymce/plugins/help/plugin';
import 'tinymce/plugins/wordcount/plugin';

tinymce.init({
    selector: '#content',
    theme: 'modern',
    height: 500,
    width: 800,
    menubar: true,
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample code',
    plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount'
    ],
    //toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
});