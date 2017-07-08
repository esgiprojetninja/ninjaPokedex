import $ from "jquery";

const base_url = "/types";

export default class TypeApi {
    constructor () {
    }

    getAllTypes() {
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
}
