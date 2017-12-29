class Errors {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.errors = {};
    }


    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        return this.errors.hasOwnProperty(field);
    }


    /**
     * Determine if we have any errors.
     */
    any() {
        return Object.keys(this.errors).length > 0;
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }


    /**
     * Record the new errors.
     *
     * @param {object} errors
     */
    record(errors) {
        this.errors = errors;
    }


    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}

export class Form {
  /**
  * Crear nueva instancia de Form
  * @param {json} field
  */
  constructor(data) {
    this.originalData = data

    for (let field in data) {
      this[field] = data[field]
    }

    this.errors = new Errors()

    this.snackbar = new Snackbar()
  }

  /**
  * Fetch all relevant data for the form.
  */
  data() {
    let data = {}

    for (let property in this.originalData) {
      data[property] = this[property]
    }

    return data
  }

  /**
  * Load data
  * @param {string} url
  */
  edit(url) {
    axios.get(url)
      .then(res => {
        for (let field in this.originalData) {
          this[field] = res.data[field]
        }
      })
  }

  /**
  * Reset the form fields.
  */
  reset() {
      for (let field in this.originalData) {
          this[field] = '';
      }

      this.errors.clear();
  }

  /**
  * Submit Form
  * @param {string} requestType
  * @param {string} url
  */
  submit(requestType, url) {
    return new Promise((resolve, reject) => {
      axios[requestType](url, this.data())
        .then(response => {
          this.onSuccess(response.data)
          resolve(response.data)
        })
        .catch(error => {
          this.onFail(error.response.data.errors)
          reject(error.response.data)
        })
    })
  }

  /**
   * Handle a successful form submission.
   * @param {object} data
   */
  onSuccess(data) {
      //alert(data.message) // temporary
      this.snackbar.onSuccess(data.message)
      this.reset()
  }


  /**
   * Handle a failed form submission.
   * @param {object} errors
   */
  onFail(errors) {
    this.snackbar.onFail('Parece que ha habido un error!')
      this.errors.record(errors)
  }
}

class Snackbar {

  constructor() {
    this.color = ''
    this.icon = ''
    this.message = ''
    this.show = false
  }

  onSuccess(msg) {
    this.color = 'success'
    this.icon = 'fa-check'
    this.message = msg
    this.show = true
  }

  onFail(msg) {
    this.color = 'error'
    this.icon = 'fa-close'
    this.message = msg
    this.show = true
  }

}
