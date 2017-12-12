export class Table {
  constructor(arr) {
    this.headers = arr
    this.items = []
    this.isLoading = false
  }
  loadData(url) {
    axios.get(url)
      .then(res => {
        this.items = res.data
      })
  }
}
