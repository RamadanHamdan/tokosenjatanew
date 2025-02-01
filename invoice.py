invoice_number = 1001  # Initial value (store this persistently, e.g., in a database)

def generate_invoice_number():
    global invoice_number
    number = invoice_number
    invoice_number += 1
    return f"INV-{number}"  # Format with a prefix

new_invoice_number = generate_invoice_number()  # Returns "INV-1001", "INV-1002", etc.