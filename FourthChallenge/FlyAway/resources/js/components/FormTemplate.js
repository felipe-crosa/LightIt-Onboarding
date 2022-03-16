
export default class Form{
    constructor(data){
        this.data=data //fijarse para que sirve
        for(let field in data){
            this[field]=data[field]
        }
        this.errors=new Errors()
    }

    submit(requestType,url){
        return new Promise((resolve,reject)=>{
            axios[requestType](url,this.getData()).then(response=>{
                if(requestType=='post'){
                    this.reset()
                }

                resolve(response.data)
            }).catch(error=>{
                this.errors.set(error.response.data)
                reject(error.response.data)
            })

        })
    }
    getData(){
        let data={}
        for(let field in this.data){
            data[field]=this[field]
        }

        return data
    }
    reset(){
        for(let field in this.data){
            this[field]=''
        }
        this.errors.clear()
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
        return this.errors.hasOwnProperty(field)
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
        (field) ? delete this.errors[field] : this.errors={};
    }
}
