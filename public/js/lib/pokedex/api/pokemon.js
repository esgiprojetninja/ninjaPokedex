import $ from "jquery";

const base_url = "/pokemons";

export default class PokemonApi {
    constructor () {
    }

    getAll(callback) {
        $.ajax({
            method: "GET",
            url: base_url
        }).done( response => {
            callback(response);
        }).fail( response => {
            callback({error: response})
        });
    }
    get(id = 1, callback) {
        $.ajax({
            method: "GET",
            url: base_url + `/${id}`
        }).done( response => {
            callback(response);
        }).fail( response => {
            callback({error: response})
        });
    }
    create(data = {name: "blabla", osef: "ahok"}, callback) {
        $.ajax({
            method: "POST",
            url: base_url + "/create",
            data
        }).done( response => {
            callback(response);
        }).fail( response  => {
            callback({error: response})
        });
    }
    update(id = 1, data = {name: "blabla", osef: "ahok"}, callback) {
        $.ajax({
            method: "PUT",
            url: base_url + "/update/" + id,
            data
        }).done( response => {
            callback(response);
        }).fail( response  => {
            callback({error: response})
        });
    }
    delete(id = 1, callback) {
        $.ajax({
            method: "DELETE",
            url: base_url + "/delete/" + id
        }).done( response => {
            callback(response);
        }).fail( response  => {
            callback({error: response})
        });
    }
    marked(callback){
      $.ajax({
          method: "GET",
          url: base_url + "/marked"
      }).done( response => {
          callback(response);
      }).fail( response => {
          callback({error: response})
      });
    }

}
