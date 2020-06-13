function log(...e) {
    e.length === 1 ? console.log(e[0]) : console.log(e)
}

function query(name, type = 'string') {
    let query = name => {
        name = name.replace(/[\[\]]/g, '\\$&')
        let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)')
        let results = regex.exec(window.location.href)
        if(! results) {
            return null
        }
        if(! results[2]) {
            return ''
        }
        return decodeURIComponent(results[2].replace(/\+/g, ' '))
    }
    let value = query(name)
    switch(type) {
        case 'integer':
            // no break
        case 'int':
            let number = window.parseInt(value)
            return isNaN(number) ? '' : number
        default:
            return value
    }
}

function to(url, query) {
    if(typeof url !== 'string') {
        query = url
        url = window.location.origin + window.location.pathname
    }
    let oldQuery = {}
    let oldQueryStr = window.location.search.substr(1).split('&')
    oldQueryStr.forEach(e => {
        let [key, val] = e.split('=')
        oldQuery[key] = val
    })
    query = Object.assign(oldQuery, query)
    let queryArr = []
    let queryStr = '?'
    for(let key in query) {
        query[key] != null && query[key] !== '' && queryArr.push(key + '=' + query[key])
    }
    if(queryArr) {
        queryStr += (queryArr.join('&'))
        window.location.href = url + queryStr
    } else {
        window.location.href = url
    }
}

function submit(url, data) {
    if(typeof url === 'object') {
        data = url
        url = window.location.href
    }
    let form = document.createElement('form')
    form.style.display = 'none'
    form.action = url
    form.method = 'POST'
    let formData = obj2Url(data)
    for(let key in formData) {
        let val = formData[key]
        let inp = document.createElement('input')
        inp.name = key
        inp.value = val
        form.appendChild(inp)
    }
    document.body.appendChild(form)
    form.submit()
}

function obj2Url(obj) {
    let form = {}
    let helper = {
        run(obj) {
            for(let key in obj) {
                let val = obj[key]
                if(typeof val === 'object') {
                    this.handle(val, [key])
                } else {
                    form[key] = val
                }
            }
        },
        handle(obj, prefix) {
            for(let key in obj) {
                let htmlKey = ''
                let val = obj[key]
                if(typeof val === 'object') {
                    let newPrefix = prefix.concat(key)
                    this.handle(val, newPrefix)
                } else {
                    for(let i = 0;i < prefix.length;i++) {
                        htmlKey += (i === 0 ? prefix[i] : `[${prefix[i]}]`)
                    }
                    htmlKey += `[${key}]`
                    form[htmlKey] = val
                }
            }
        }
    }
    helper.run(obj)
    return form
}

function fet(url, data, method = 'get') {
    method = method.toLowerCase()
    if(method === 'get' && data) {
        url += ('?' + new URLSearchParams(obj2Url(data)))
    }
    let option = {
        credentials: 'include',
        method,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        mode: 'cors',
    }
    if(method === 'post') {
        option.headers['Content-Type'] = 'application/json'
        option.body = JSON.stringify(data)
    }
    return fetch(url, option).then(r => r.json())
}