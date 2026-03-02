<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body { font-family: 'DM Sans', Arial, sans-serif; background: #f7f4ef; margin: 0; padding: 0; }
    .wrapper { max-width: 560px; margin: 40px auto; }
    .header { background: #0f0f0f; padding: 40px 40px 36px; border-radius: 4px 4px 0 0; }
    .header .tag { display: inline-block; background: #c8420a; color: white; font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; padding: 5px 12px; border-radius: 2px; margin-bottom: 20px; }
    .header h1 { font-family: Georgia, 'Times New Roman', serif; font-size: 26px; color: white; margin: 0 0 8px; font-weight: 700; }
    .header p { font-size: 13px; color: rgba(255,255,255,0.6); margin: 0; line-height: 1.6; }
    .body { background: white; padding: 36px 40px; border-radius: 0 0 4px 4px; border: 1px solid #ddd8d0; border-top: none; }
    .body p { font-size: 14px; color: #0f0f0f; line-height: 1.7; margin: 0 0 16px; }
    .highlight { background: #f7f4ef; border-left: 3px solid #c8420a; padding: 14px 18px; border-radius: 0 3px 3px 0; margin: 20px 0; }
    .highlight p { margin: 0; font-size: 13px; color: #7a7065; }
    .footer { text-align: center; margin-top: 24px; font-size: 11px; color: #7a7065; line-height: 1.6; }
</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="tag">◆ Printbuka</div>
        <h1>Evaluation Received</h1>
        <p>2025 Staff Performance Review — Confidential</p>
    </div>
    <div class="body">
        <p>Hi {{ $evaluation->full_name }},</p>

        <p>
            Thank you for completing your performance evaluation. Your submission has been received and will be reviewed confidentially as part of Printbuka's internal restructuring process.
        </p>

        <div class="highlight">
            <p><strong>Submitted:</strong> {{ now()->format('F j, Y \a\t g:i A') }}</p>
            <p style="margin-top:6px;"><strong>Department:</strong> {{ $evaluation->department }}</p>
            <p style="margin-top:6px;"><strong>Tenure:</strong> {{ $evaluation->tenure }}</p>
        </div>

        <p>
            Your honest feedback matters. The management team will use your responses to make meaningful improvements to operations, team structure, and compensation.
        </p>

        <p>
            If you have any concerns or additional feedback to share, please reach out to HR directly.
        </p>

        <p style="margin-bottom: 0;">
            Warm regards,<br>
            <strong>Printbuka HR Team</strong>
        </p>
    </div>
    <div class="footer">
        This email was sent to {{ $evaluation->email }} because you submitted a staff evaluation form.<br>
        All information is strictly confidential and used internally only.
    </div>
</div>
</body>
</html>
