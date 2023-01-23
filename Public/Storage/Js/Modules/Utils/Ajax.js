export class Ajax {
  /**
   *
   * @param {String} url - target;
   * @param {String} method - post, get ...;
   * @param {String} contentType - Request content type eg: application/json;
   * @param {String} Accept - expected data content type eg: application/json;
   * @param {*} body - Data
   */
  static async http(url, method, contentType, Accept, body) {
    try {
      const res = await fetch(url, {
        method: method,
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
          "Content-Type": contentType,
          Accept: Accept, // expected data sent back
        },
        body: body
      
      });
      const data = await res.json();
      return data;
    } catch (error) {
      return { "code": 400, "msg": error };
    }
  }
}

