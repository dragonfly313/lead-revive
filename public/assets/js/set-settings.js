let changedBtnData = {}, changedIconData = {}, iconId

const onBackColorChange = e => {
    const { id, value } = e.target

    switch (id) {
        case 'headerBackColor':
            $('#header').css('background-color', value)
            break;
        case 'bodyBackColor':
            $('section').css('background-color', value)
            break;
        case 'footerBackColor':
            $('#footer').css('background-color', value)
            break;
        default:
            break;
    }
}

const save = () => {
    let upsert_data = []

    const headerBackColor = $('#headerBackColor').val()
    const bodyBackColor = $('#bodyBackColor').val()
    const footerBackColor = $('#footerBackColor').val()

    if (headerBackColor !== defaultBackColor.headerBackColor) {
        upsert_data = [...upsert_data, { key: 'headerBackColor', type: 'backColor', value: headerBackColor }]
    }

    if (bodyBackColor !== defaultBackColor.bodyBackColor) {
        upsert_data = [...upsert_data, { key: 'bodyBackColor', type: 'backColor', value: bodyBackColor }]
    }

    if (footerBackColor !== defaultBackColor.footerBackColor) {
        upsert_data = [...upsert_data, { key: 'footerBackColor', type: 'backColor', value: footerBackColor }]
    }

    // put changed textData to upsert_data
    let value
    Object.keys(defaultText).forEach(key => {
        value = $(`#${key}`).text()
        if (value !== defaultText[key]) {
            upsert_data = [...upsert_data, { key, type: 'text', value }]
        }
    });

    // put changed btnData to upsert_data
    Object.keys(changedBtnData).forEach(key => {
        upsert_data = [...upsert_data, { key, type: 'button', value: changedBtnData[key] }]
    });

    // put changed iconData to upsert_data
    Object.keys(changedIconData).forEach(key => {
        upsert_data = [...upsert_data, { key, type: 'icon', value: changedIconData[key] }]
    });

    if (upsert_data.length > 0) {
        $.post('/account/websites/compose', {
            upsert_data
        }).then(res => {
            if (res.result === 'success') {
                toastr.success("Save success");
                updateDefaultData(upsert_data)
                changedBtnData = {}
            }
        })
    } else {
        toastr.options.closeButton = true;
        toastr.warning("No change to save");
    }
}

const updateDefaultData = (receivedData) => {
    receivedData.forEach(item => {
        if (item.key === 'headerBackColor') {
            defaultBackColor[item.key] = item.value
        } else if (item.key === 'bodyBackColor') {
            defaultBackColor[item.key] = item.value
        } else if (item.key === 'footerBackColor') {
            defaultBackColor[item.key] = item.value
        } else if (item.type === 'text') {
            defaultText[item.key] = item.value
        }
    });
}

const onImgChange = e => {
    let { id, files: [file] } = e.target

    if (file) {
        //Check the file type.
        if (!['image/png', 'image/jpeg'].includes(file.type)) {
            toastr.warning('You can upload only png or jpeg file.');
            return;
        }

        if (file.size >= 2000000) {
            toastr.warning('You cannot upload this file because its size exceeds the maximum limit of 2 MB.')
            return;
        }

        let formData = new FormData()
        let filename = id.slice(0, -6) + '.png'
        formData.append('file', file, filename)

        // Set up the request.
        var xhr = new XMLHttpRequest();

        // Open the connection.
        xhr.open('POST', '/account/websites/compose/upload', true);


        // Set up a handler for when the task for the request is complete.
        xhr.onload = function () {
            if (xhr.status === 200) {
                toastr.success('Your upload is successful')
                $(`#${id.slice(0, -6)}_img`).attr('src', URL.createObjectURL(file))
            } else {
                toastr.warning('An error occurred during the upload. Try again.')
            }
        };

        // Send the data.
        xhr.send(formData);
    }
}

const btnSet = (id) => {
    let content = $(`#${id}-content`).val()
    let type = $(`#${id}-type`).val()
    let outline = $(`#${id}-outline`).val()
    let size = $(`#${id}-size`).val()
    let border_radius = $(`#${id}-border_radius`).val()

    let data = { content, type, outline, size, border_radius }

    setBtnStyle(id, data)

    changedBtnData[id] = JSON.stringify(data)
}

const onIconClick = (id) => {
    iconId = id
    $('#modalTrigger').click()

    let dom = $('#' + id)
    let classes = dom.attr('class'),
        fontSize = dom.css('font-size'),
        color = dom.css('color')

    $('#icon-preview').attr('class', classes)
    $('#icon-preview').css('font-size', fontSize)
    $('#icon-preview').css('color', color)

    fontSize = Number(fontSize.slice(0, fontSize.length - 2))
    $('#icon-size').val(fontSize)
    $('#icon-color').val(color)
}

const chooseIcon = (icon) => {
    $('#icon-preview').attr('class', 'fa-brands fa-' + icon)
}

const onSizeChange = (e) => {
    $('#icon-preview').css('font-size', e.target.value + 'px')
}

const onColorChange = (e) => {
    $('#icon-preview').css('color', e.target.value)
}

const iconSet = () => {
    let dom = $('#icon-preview')
    let classes = dom.attr('class')
    let fontSize = dom.css('font-size')
    let color = dom.css('color')

    let iconDom = $('#' + iconId)
    iconDom.attr('class', classes)
    iconDom.css('font-size', fontSize)
    iconDom.css('color', color)

    const data = { classes, fontSize, color }

    changedIconData[iconId] = JSON.stringify(data)
}
