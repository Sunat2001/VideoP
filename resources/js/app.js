import './bootstrap';
import 'select2';
import bsCustomFileInput from 'bs-custom-file-input';

$(document).ready(function() {
    $('.select2').select2();
});

$(document).ready(function () {
    bsCustomFileInput.init()
})
