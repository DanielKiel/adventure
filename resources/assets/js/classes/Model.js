/**
 * depends on integration: https://github.com/aaronlord/laroute
 *
 * use it like this:
 *
 * let location = new Model('locations', 'location')
 *
 * location.fetch().then( (response) => {} ).catch( (error) => {} )
 * location.show(1).then( (response) => {} ).catch( (error) => {} )
 */

export default class Model {
    constructor(routePrefix, identifierName) {
        this.routePrefix = routePrefix
        //needed cause laravel make route param id to model name, for example id will be location for Location
        this.identifierName = identifierName
    }

    fetch() {
       return this.__doRequest('GET', laroute.route(this.routePrefix + '.index'),{})
    }

    search(query, data) {
        if (data === undefined) {
            data = {}
        }

        let output = "";

        for(let i = 0; i < query.length; i++){
            output = output + "&query[" +i+ "][leftOperand]=" + query[i].leftOperand + "&query[" +i+ "][operand]="
                + query[i].operand + "&query[" +i+ "][rightOperand]=" + query[i].rightOperand
        }

        return this.__doRequest('GET', laroute.route(this.routePrefix + '.search',{
            query:output,
            page: data.page

        }))
    }

    show(id) {
        let params = {}
        params[this.identifierName] = id

        return this.__doRequest('GET', laroute.route(this.routePrefix + '.show',params),{})
    }

    store(data) {
        return this.__doRequest('PUT', laroute.route(this.routePrefix + '.store'),data)
    }

    update(data) {
        let params = {}
        params[this.identifierName] = data.id

        return this.__doRequest('PUT', laroute.route(this.routePrefix + '.update',params),data)
    }

    delete(id) {
        let params = {}
        params[this.identifierName] = id

        return this.__doRequest('DELETE', laroute.route(this.routePrefix + '.delete',params),{})
    }

    __doRequest(method, url, data) {
        return axios({
            method: method,
            url: url,
            data: data,
            headers: { 'content-type': 'application/json' },
        })
    }
}
