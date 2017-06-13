import $ from "jquery";

const base_url = "/pokemons";

export default class PokemonApi {
    constructor () {
    }

    getAll() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: base_url
            }).done( response => {
                resolve(response);
            }).fail( response => {
                reject({error: response})
            });
        });
    }
    get(id = 1) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: base_url + `/${id}`
            }).done( response => {
                resolve(response);
            }).fail( response => {
                reject({error: response})
            });
        });
    }
    create(data = {name: "blabla", osef: "ahok"}) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "POST",
                url: base_url + "/create",
                data
            }).done( response => {
                resolve(response);
            }).fail( response  => {
                reject({error: response})
            });
        });
    }
    update(id = 1, data = {name: "blabla", osef: "ahok"}) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "PUT",
                url: base_url + "/update/" + id,
                data
            }).done( response => {
                resolve(response);
            }).fail( response  => {
                reject({error: response})
            });
        });
    }
    delete(id = 1, callback) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "DELETE",
                url: base_url + "/delete/" + id
            }).done( response => {
                resolve(response);
            }).fail( response  => {
                reject({error: response})
            });
        });
    }
    getMarked() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: base_url + "/marked"
            }).done( response => {
                resolve(response);
            }).fail( response => {
                reject({error: response})
            });
        });
    }


}
