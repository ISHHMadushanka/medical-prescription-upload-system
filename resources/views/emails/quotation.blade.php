<p>Dear {{ $prescription->user->name }},</p>

<p>Here are the quotation details for your prescription:</p>

<ul>
    <li>Prescription ID: {{ $prescription->id }}</li>
    <li>Quotation ID: {{ $quotation->id }}</li>
    <li>Quotation Amount: {{ $quotation->amount }}</li>
    <li>Quotation Description: {{ $quotation->description }}</li>
</ul>

<p>Thank you for using our service!</p>
