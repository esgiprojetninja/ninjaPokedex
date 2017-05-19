import $ from "jquery";

const base_url = "/pokemon";

export default class PokemonApi {
    constructor () {
    }

    getTest(callback) {
        $.ajax({
            method: "GET",
            url: base_url + "/1"
        }).done( response => {
            callback(response);
        }).fail( response => {
            callback({error: response})
        });
    }


}
