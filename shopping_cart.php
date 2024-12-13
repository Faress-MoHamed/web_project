<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - Book Store</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="shopping_cart.css" />
  </head>
  <body>
    <main class="main-content container">
      <div class="left-column">
        <div class="products">
          <h2>Products Details</h2>
          <div class="table-container">
            <table class="products-table">
              <thead>
                <tr class="table-header">
                  <th>NUM</th>
                  <th>BOOK</th>
                  <th>AMOUNT</th>
                  <th>COST</th>
                  <th>SUBTOTAL</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="table-cell index">01.</td>
                  <td class="table-cell">
                    <div class="book-info">
                      <div class="book-image-container">
                        <img
                          class="book-image"
                          src="/assets/The%20Hunger%20Games-BPxLEseF.webp"
                          alt=""
                        />
                      </div>
                      <div class="book-title">book12344555</div>
                    </div>
                  </td>
                  <td class="table-cell">
                    <div class="quantity-control">
                      <button
                        class="quantity-btn decrease"
                        aria-label="Decrease quantity of book12344555"
                      >
                        -
                      </button>
                      <span class="quantity-text">2</span>
                      <button
                        class="quantity-btn increase"
                        aria-label="Increase quantity of book12344555"
                      >
                        +
                      </button>
                    </div>
                  </td>
                  <td class="table-cell price">150.00 AED</td>
                  <td class="table-cell subtotal">300.00 AED</td>
                  <td class="table-cell actions">
                    <button
                      class="remove-btn"
                      aria-label="Remove book12344555 from cart"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                      </svg>
                    </button>
                  </td>
                </tr>
                <!-- Additional rows -->
              </tbody>
            </table>
          </div>
          <div class="cart-actions">
            <button class="clear-cart">Clear Cart</button>
            <button class="confirm-cart">Confirm This Cart</button>
          </div>
        </div>

        <div class="shipping-form">
          <h2>Shipping Data</h2>
          <form>
            <div class="form-group">
              <label>Card number</label>
              <input type="text" placeholder="Card number" />
            </div>
            <div class="form-group">
              <label>First name</label>
              <input type="text" placeholder="First name" />
            </div>
            <div class="form-group">
              <label>Last name</label>
              <input type="text" placeholder="Last name" />
            </div>
            <div class="form-group">
              <label>Country or region</label>
              <select>
                <option>United States</option>
                <option>United Kingdom</option>
                <option>Canada</option>
              </select>
            </div>
            <div class="form-group">
              <label>Address line 1</label>
              <input type="text" placeholder="Address" />
            </div>
            <button type="submit" class="proceed-btn">
              Proceed <i class="bx bx-cart"></i>
            </button>
          </form>
        </div>
      </div>

      <div class="cart-total">
        <h2>Cart Total Cost</h2>
        <div class="total-row">
          <span>Total</span>
          <span>900.00 AED</span>
        </div>
        <div class="total-row">
          <span>Tax</span>
          <span>45.00 AED</span>
        </div>
        <div class="total-row">
          <span>Total Cost</span>
          <span>945.00 AED</span>
        </div>
      </div>
    </main>
  </body>
</html>
