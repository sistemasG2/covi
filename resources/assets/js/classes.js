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
  }
  /**
   * Load items from given url
   *
   * @param {string} url
   */
  loadData(url) {
    axios.get(url)
      .then(res => {
        this.items = res.data
      })
  }
}
