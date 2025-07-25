
🧪 Formsort → Laravel Backend → Dosable Integration

### This project is a backend bridge between Formsort and the Dosable platform. It accepts a form from Formsort, creates a session in Dosable, registers a user (lead), sends responses, and completes the intake

### Docker 
```
cp .env.example .env
```

### In .env fill this:
```
APP_URL=http://localhost
DOSABLE_URL=https://staging.intake.dosable.com
DOSABLE_TOKEN=your_dosable_token_here
```
### Configure nginx (docker/nginx/default.conf)
```
 listen 
 server_name
 and install ssl
```

### In config/cors.php fill this:
```
'paths' => ['api/*'],
'allowed_origins' => ['https://formsort.com'],
```

### Then make this commands:
```
docker-compose up -d --build
docker-compose exec api php artisan key:generate
docker-compose exec api php artisan migrate
```

### Route for Formsort:
```
METHOD POST https://{domain}/api/formsort
```

### Example payload:
```
{
  "first_name": "Jane",
  "last_name": "Doe",
  "email": "shum26@gmail.com",
  "phone": "7962651291",
  "name" : "Jane",
  "gender": "Female",
  "lead_state": "CA",
  "birthday": "04/12/1989",
  "901.value": "Female",
  "901.question": "What was your sex assigned at birth?",
  "902.value": "No",
  "902.question": "Are you currently pregnant, breastfeeding or planning to become pregnant?",
  "922.value": "I have read and understand the information and I wish to continue",
  "922.question":  "<h2>Consent (Nail Fungus Treatment)</h2>\n                                <h3>Introduction</h3>\n                                <p>\n                                    You have been diagnosed with onychomycosis (nail fungus), a common fungal infection of the nails \n                                    that can cause discoloration, thickening, brittleness, and separation of the nail from the nail bed. \n                                    This condition is often caused by dermatophytes, yeasts, or molds. Onychomycosis can affect both fingernails \n                                    and toenails and may result in discomfort, pain, or cosmetic concerns if left untreated.\n                                </p>\n                                <h3>Purpose of Treatment</h3>\n                                <p>\n                                    The goal of nail fungus treatment is to eradicate the fungal infection, restore the health and \n                                    appearance of the nails, and prevent recurrence. Treatment plans are personalized and may include \n                                    topical or oral medications, and preventive strategies based on the severity and type of infection.\n                                </p>\n                                <h3>Treatment Options</h3>\n                                <h4>Topical Antifungal Medications:</h4>\n                                <ul>\n                                    <li>Ciclopirox</li>\n                                    <li>Efinaconazole</li>\n                                    <li>Tavaborole</li>\n                                    <li>Other combinations of therapy</li>\n                                </ul>\n                                <h4>Oral Antifungal Medications:</h4>\n                                <ul>\n                                    <li>Terbinafine</li>\n                                    <li>Itraconazole</li>\n                                    <li>Fluconazole</li>\n                                    <li>Other combinations of therapy</li>\n                                </ul>\n                                <h4>Preventive Measures:</h4>\n                                <ul>\n                                    <li>Keeping nails clean and dry.</li>\n                                    <li>Avoiding tight-fitting shoes.</li>\n                                    <li>Using antifungal powders or sprays.</li>\n                                </ul>\n                                <h3>Potential Benefits</h3>\n                                <ul>\n                                    <li>Elimination of the fungal infection.</li>\n                                    <li>Improved nail appearance, texture, and integrity.</li>\n                                    <li>Reduction in discomfort or pain caused by the infection.</li>\n                                    <li>Prevention of recurrence with proper care and adherence to preventive measures.</li>\n                                </ul>\n                                <h3>Potential Risks and Side Effects</h3>\n                                <h4>Topical Medications:</h4>\n                                <ul>\n                                    <li>Skin irritation, redness, or peeling around the nails.</li>\n                                    <li>Allergic reactions to the medication.</li>\n                                </ul>\n                                <h4>Oral Medications:</h4>\n                                <ul>\n                                    <li>Nausea, stomach upset, or headaches.</li>\n                                    <li>Liver toxicity or elevated liver enzymes (rare but serious).</li>\n                                    <li>Interaction with other medications or supplements.</li>\n                                </ul>\n                                <h4>General Risks:</h4>\n                                <ul>\n                                    <li>Ineffectiveness of treatment, requiring alternative approaches.</li>\n                                    <li>Recurrence of the infection if preventive measures are not followed.</li>\n                                    <li>Psychological impact if desired results are not achieved.</li>\n                                </ul>\n                                <h3>Pregnancy and Breastfeeding Precautions</h3>\n                                <p>\n                                    Some antifungal medications may not be safe during pregnancy or breastfeeding. \n                                    Inform your healthcare provider if you are pregnant, planning to become pregnant, or breastfeeding.\n                                </p>\n                                <h3>Patient Responsibilities</h3>\n                                <ul>\n                                    <li><strong>Medical Disclosure:</strong> Inform your provider of all medications, supplements, allergies, and medical conditions, including pregnancy or breastfeeding status.</li>\n                                    <li><strong>Treatment Adherence:</strong> Follow the prescribed treatment regimen and application instructions exactly as directed.</li>\n                                    <li><strong>Appointments:</strong> Attend all scheduled follow-up visits to assess progress and adjust treatment as needed.</li>\n                                    <li><strong>Communication:</strong> Report any side effects, adverse reactions, or concerns promptly.</li>\n                                    <li><strong>Nail Care:</strong> Maintain proper nail hygiene and avoid trauma or moisture exposure to enhance treatment effectiveness.</li>\n                                </ul>\n                                <h3>Alternative Treatments</h3>\n                                <ul>\n                                    <li><strong>Over-the-Counter Products:</strong> Non-prescription antifungal creams or nail lacquers.</li>\n                                    <li><strong>Natural Remedies:</strong> Tea tree oil, vinegar soaks, or other home remedies (efficacy may vary).</li>\n                                    <li><strong>No Treatment:</strong> Choosing not to pursue treatment, understanding the potential progression of the infection.</li>\n                                </ul>\n                                <h3>Acknowledgment and Consent</h3>\n                                <p>By selecting below, you acknowledge that:</p>\n                                <ul>\n                                    <li>You have been informed about your diagnosis and the proposed treatment options for nail fungus.</li>\n                                    <li>You understand the potential benefits, risks, and side effects associated with the treatment.</li>\n                                    <li>You agree to inform your healthcare provider of any changes in your health or reactions to the treatment.</li>\n                                    <li>You commit to following the treatment plan and preventive measures provided.</li>\n                                    <li>You consent to proceed with the recommended treatment plan, understanding that you may withdraw consent or discontinue treatment at any time.</li>\n                                </ul>"
}
```

### Note:
in payload must be valid data:
1. email  — unique
2. phone — unique
3. 922.value — required 
4. 922.question — required
5. lead_state — valid state in two uppercase characters 
6. birthday — 04/12/1989 - only this format!
7. gender — "Female", "Male"

All requirements you can see on https://staging.intake.dosable.com/questions/ METHOD GET with header X-API-KEY: {api_key}


### At last
1. Go to https://formsort.com/ admin panel and configure the url for this backend api.