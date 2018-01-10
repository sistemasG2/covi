export class Modal {

  /**
  * Create instance of Modal
  * @param {array} options with options
  */
  constructor(arr = []) {

    this.originalArr = arr

    for (let option in arr) {
      this[arr[option]] = false
    }

    this.show = false
    this.text = false
  }

  clearOptions() {
    for (let option in this.originalArr) {
      this[this.originalArr[option]] = false
    }
    this.show = false
    this.text = false
  }

  /**
   *
   * @param {string} options
   * @param {string} text
   */
  open(str, text = '') {
    this.clearOptions()
    this[str] = true
    this.text = text
    this.show = true
  }

  close() {
    this.clearOptions()
  }

}

export class Table {
  /**
   * Create new instance of Table
   *
   * @param array with table headers
   */
  constructor(array) {
    this.headers = array
    this.items = []
    this.isLoading = false
    this.pagination = {}
  }
  /**
   * Load items from given url
   *
   * @param {string} url
   */
  loadData(url) {
    // axios.get(url)
    //   .then(res => {
    //     this.items = res.data
    //   })
    return new Promise((resolve, reject) => {
      axios.get(url)
        .then(response => {
          this.items = response.data
          resolve(response.data)
        })
        .catch(error => {
          reject(error.response.data)
        })
    })
  }
}

export class Searchbox {
  constructor() {
    this.search = ''
    this.items = []
  }

  setItems(items) {
    this.items = items
  }

  filteredItems() {
    if (this.search && this.toggleViewOptions == 0) {
      let items = this.items
      let result = [];

      for (var i = 0; i < items.length; i++) {
        let verified = false
        Object.keys(items[i]).some(prop => {
          let item = items[i][prop]
          if (item) {
            let content = item.toString().toLowerCase()
            if (content.includes(this.search.toLowerCase())) {
              verified = true
            }
          }
        })
        if (verified == true) {
          result.push(items[i])
        }
      }

      return result
    }

    return this.items
  }
}
