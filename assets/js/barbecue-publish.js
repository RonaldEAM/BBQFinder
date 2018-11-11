import '../scss/barbecue-publish.scss';

import 'bootstrap-fileinput/js/plugins/piexif';
import 'bootstrap-fileinput/js/fileinput';
import 'bootstrap-fileinput/themes/fa/theme';
import 'bootstrap-fileinput/js/locales/es';

import tagsInput from 'tags-input';

$(function() {
    $("#picture").fileinput({
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 1,
    });

    let inputTag = document.getElementById('properties');
    tagsInput(inputTag);

    var properties = $('#properties')[0];
    properties.addEventListener('change', updateProperties);

    function updateProperties(e) {
        let propsArray = this.value.split(',');
        $('#hidden-properties').empty();
        for (let index = 0; index < propsArray.length; index++) {
            const property = propsArray[index];
            $('<input>').attr({
                type: 'hidden',
                name: 'barbecue[properties]['+index+']',
                value: property
            }).appendTo($('#hidden-properties'));
        }
    }
});