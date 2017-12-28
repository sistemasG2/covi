export class CrudModal {

  constructor() {
    this.create = false
    this.delete = false
    this.edit = false
    this.show = false
    this.text = ''
    this.view = false
  }

  clearOptions() {
    this.create = false
    this.delete = false
    this.edit = false
    this.show = false
    this.text = ''
    this.view = false
  }

  /**
   *
   * @param {string} options
   * @param {string} text
   */
  open(str, text) {
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
