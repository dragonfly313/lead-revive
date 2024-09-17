const setBtnStyle = (id, data) => {
    let btnTarget = $(`#${id}`)

    btnTarget.text(data.content)

    let classes = 'btn btn-'

    if (data.outline === 'true') {
        classes += 'outline-'
    }

    classes += data.type

    if (data.size !== 'md') {
        classes += ' btn-' + data.size
    }

    switch (data.border_radius) {
        case 'none':
            classes += ' rounded-0'
            break;

        case 'pill':
            classes += ' rounded-pill'
            break;

        default:
            break;
    }

    btnTarget.attr('class', classes)
}

const setBtnModalContents = (id, data) => {
    let keys = ['content', 'type', 'outline', 'size', 'border_radius']

    keys.forEach(key => {
        $(`#${id}-${key}`).val(data[key])
    });
}

if (receivedData.length > 0) {
    receivedData.forEach(item => {
        if (item.key === 'headerBackColor' && defaultBackColor[item.key] !== item.value) {
            defaultBackColor[item.key] = item.value
            $('#headerBackColor').val(item.value)
            $('#header').css('background-color', item.value)
        } else if (item.key === 'bodyBackColor' && defaultBackColor[item.key] !== item.value) {
            defaultBackColor[item.key] = item.value
            $('#bodyBackColor').val(item.value)
            $('section').css('background-color', item.value)
        } else if (item.key === 'footerBackColor' && defaultBackColor[item.key] !== item.value) {
            defaultBackColor[item.key] = item.value
            $('#footerBackColor').val(item.value)
            $('.footer').css('background-color', item.value)
        } else if (item.type === 'text' && Object.keys(defaultText).includes(item.key) && defaultText[item.key] !== item.value) {
            defaultText[item.key] = item.value
            $(`#${item.key}`).text(item.value)
        } else if (item.type === 'button') {
            let value = JSON.parse(item.value)
            
            setBtnStyle(item.key, value)
            setBtnModalContents(item.key, value)
        } else if (item.type === 'icon') {
            let value = JSON.parse(item.value)
            let dom = $('#' + item.key)

            dom.attr('class', value.classes)
            dom.css('font-size', value.fontSize)
            dom.css('color', value.color)
        }
    });
}
