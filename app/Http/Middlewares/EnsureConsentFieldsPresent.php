<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EnsureConsentFieldsPresent
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->json()->all();

        if (!Arr::has($input, '922.value')) {
            $request->attributes->set('922.value', 'I have read and understand the information and I wish to continue');
        }

        if (!Arr::has($input, '922.question')) {
            $request->attributes->set('922.question', $this->getConsentHtml());
        }

        return $next($request);
    }

    private function getConsentHtml(): string
    {
        return <<<HTML
<h2>Consent (Nail Fungus Treatment)</h2>
<h3>Introduction</h3>
<p>
    You have been diagnosed with onychomycosis (nail fungus), a common fungal infection of the nails 
    that can cause discoloration, thickening, brittleness, and separation of the nail from the nail bed. 
    This condition is often caused by dermatophytes, yeasts, or molds. Onychomycosis can affect both fingernails 
    and toenails and may result in discomfort, pain, or cosmetic concerns if left untreated.
</p>
<h3>Purpose of Treatment</h3>
<p>
    The goal of nail fungus treatment is to eradicate the fungal infection, restore the health and 
    appearance of the nails, and prevent recurrence. Treatment plans are personalized and may include 
    topical or oral medications, and preventive strategies based on the severity and type of infection.
</p>
<h3>Treatment Options</h3>
<h4>Topical Antifungal Medications:</h4>
<ul>
    <li>Ciclopirox</li>
    <li>Efinaconazole</li>
    <li>Tavaborole</li>
    <li>Other combinations of therapy</li>
</ul>
<h4>Oral Antifungal Medications:</h4>
<ul>
    <li>Terbinafine</li>
    <li>Itraconazole</li>
    <li>Fluconazole</li>
    <li>Other combinations of therapy</li>
</ul>
<h4>Preventive Measures:</h4>
<ul>
    <li>Keeping nails clean and dry.</li>
    <li>Avoiding tight-fitting shoes.</li>
    <li>Using antifungal powders or sprays.</li>
</ul>
<h3>Potential Benefits</h3>
<ul>
    <li>Elimination of the fungal infection.</li>
    <li>Improved nail appearance, texture, and integrity.</li>
    <li>Reduction in discomfort or pain caused by the infection.</li>
    <li>Prevention of recurrence with proper care and adherence to preventive measures.</li>
</ul>
<h3>Potential Risks and Side Effects</h3>
<h4>Topical Medications:</h4>
<ul>
    <li>Skin irritation, redness, or peeling around the nails.</li>
    <li>Allergic reactions to the medication.</li>
</ul>
<h4>Oral Medications:</h4>
<ul>
    <li>Nausea, stomach upset, or headaches.</li>
    <li>Liver toxicity or elevated liver enzymes (rare but serious).</li>
    <li>Interaction with other medications or supplements.</li>
</ul>
<h4>General Risks:</h4>
<ul>
    <li>Ineffectiveness of treatment, requiring alternative approaches.</li>
    <li>Recurrence of the infection if preventive measures are not followed.</li>
    <li>Psychological impact if desired results are not achieved.</li>
</ul>
<h3>Pregnancy and Breastfeeding Precautions</h3>
<p>
    Some antifungal medications may not be safe during pregnancy or breastfeeding. 
    Inform your healthcare provider if you are pregnant, planning to become pregnant, or breastfeeding.
</p>
<h3>Patient Responsibilities</h3>
<ul>
    <li><strong>Medical Disclosure:</strong> Inform your provider of all medications, supplements, allergies, and medical conditions, including pregnancy or breastfeeding status.</li>
    <li><strong>Treatment Adherence:</strong> Follow the prescribed treatment regimen and application instructions exactly as directed.</li>
    <li><strong>Appointments:</strong> Attend all scheduled follow-up visits to assess progress and adjust treatment as needed.</li>
    <li><strong>Communication:</strong> Report any side effects, adverse reactions, or concerns promptly.</li>
    <li><strong>Nail Care:</strong> Maintain proper nail hygiene and avoid trauma or moisture exposure to enhance treatment effectiveness.</li>
</ul>
<h3>Alternative Treatments</h3>
<ul>
    <li><strong>Over-the-Counter Products:</strong> Non-prescription antifungal creams or nail lacquers.</li>
    <li><strong>Natural Remedies:</strong> Tea tree oil, vinegar soaks, or other home remedies (efficacy may vary).</li>
    <li><strong>No Treatment:</strong> Choosing not to pursue treatment, understanding the potential progression of the infection.</li>
</ul>
<h3>Acknowledgment and Consent</h3>
<p>By selecting below, you acknowledge that:</p>
<ul>
    <li>You have been informed about your diagnosis and the proposed treatment options for nail fungus.</li>
    <li>You understand the potential benefits, risks, and side effects associated with the treatment.</li>
    <li>You agree to inform your healthcare provider of any changes in your health or reactions to the treatment.</li>
    <li>You commit to following the treatment plan and preventive measures provided.</li>
    <li>You consent to proceed with the recommended treatment plan, understanding that you may withdraw consent or discontinue treatment at any time.</li>
</ul>
HTML;
    }
}
