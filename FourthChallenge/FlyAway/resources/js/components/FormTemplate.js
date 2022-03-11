
export default class Form{
    constructor(data){
        this.data=data //fijarse para que sirve
        for(let field in data){
            this[field]=data[field]
        }
        this.errors=new Errors()
    }

    submit(requestType,url){
        //create a promise for this request
        axios[requestType](url,data())
            .catch(error=>this.errors.set(error.response.data))


    }
    data(){
        let data={}
        for(let field of this.data){
            data[field]=this[field]
        }
        return data
    }
    reset(){
        for(let field of this.data){
            this[field]=''
        }
    }
    setup(object){
        for(let field in object){
            this[field]=object[field]
        }
    }


}

export class Errors{
    constructor() {
        this.errors={}
    }
    has(field){
        return this.hasOwnProperty(field)
    }
    any(){
       return Object.keys(this.errors).length>0
    }
    get(field){
        if(this.errors[field]){
            return this.errors[field][0]
        }
    }
    set(errors){
        this.errors=errors
    }

    clear(field=null){
        (field) ? errors[field]="" : this.errors={};
    }
}
