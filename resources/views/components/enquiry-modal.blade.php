<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-xl" style="border-radius: var(--hm-radius-lg); overflow: hidden;">
      <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--hm-primary-950) 0%, var(--hm-primary-850) 100%); padding: 24px 30px;">
        <div>
          <span class="badge bg-warning text-dark text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Commercial Trade Desk</span>
          <h4 class="modal-title fw-bold text-white mb-0" id="enquiryModalLabel">Request for Quotation / Corporate Inquiry</h4>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4 p-md-5">
        <div id="enquiryFormAlert"></div>

        <form id="corporateEnquiryForm" action="{{ route('enquiry.store') }}" method="POST">
          @csrf
          <input type="hidden" name="type" id="enquiryModalType" value="general">
          <input type="hidden" name="item_id" id="enquiryModalItemId" value="">
          <input type="hidden" name="item_name" id="enquiryModalItemName" value="">
          
          {{-- Honeypot field for bot/spam prevention --}}
          <input type="text" name="website_hp" style="display:none !important;" tabindex="-1" autocomplete="off">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold small text-slate-700">Full Name / Representative <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="e.g. David Richardson" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold small text-slate-700">Corporate Email <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="e.g. d.richardson@company.com" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold small text-slate-700">Phone / WhatsApp Number <span class="text-danger">*</span></label>
              <input type="tel" name="phone" class="form-control" placeholder="e.g. +91 98000 00000 / +1 555 0192" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold small text-slate-700">Company / Organization</label>
              <input type="text" name="company" class="form-control" placeholder="e.g. Global Agri Holdings LLC">
            </div>

            <div class="col-12" id="enquiryItemDisplayGroup" style="display: none;">
              <div class="p-3 bg-light rounded border d-flex align-items-center justify-content-between">
                <div>
                  <span class="text-xs text-muted text-uppercase d-block fw-bold">Inquiring Regarding:</span>
                  <span class="fw-bold text-dark" id="enquiryItemDisplayName">-</span>
                </div>
                <span class="badge bg-primary text-uppercase" id="enquiryItemBadge">Item</span>
              </div>
            </div>

            <div class="col-12">
              <label class="form-label fw-bold small text-slate-700">Estimated Quantity / Project Scope</label>
              <input type="text" name="quantity_requirement" class="form-control" placeholder="e.g. 5,000 MT / 50,000 sq.ft PEB / 2-Acre Farmland Plot">
            </div>

            <div class="col-12">
              <label class="form-label fw-bold small text-slate-700">Detailed Requirements / Inquiries <span class="text-danger">*</span></label>
              <textarea name="message" rows="4" class="form-control" placeholder="Specify packaging preferences, delivery terms (FOB/CIF), destination ports, technical specs, or site visit scheduling..." required></textarea>
            </div>

            <div class="col-12 text-end pt-2">
              <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="hm-btn hm-btn-gold">
                <i class="bi bi-send-fill"></i> Submit Commercial RFQ
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Helper to open RFQ modal with pre-populated item details
  function openEnquiryModal(type, id, name) {
    const modalEl = document.getElementById('enquiryModal');
    if (!modalEl) return;
    document.getElementById('enquiryModalType').value = type || 'general';
    document.getElementById('enquiryModalItemId').value = id || '';
    document.getElementById('enquiryModalItemName').value = name || '';

    const displayGroup = document.getElementById('enquiryItemDisplayGroup');
    const displayName = document.getElementById('enquiryItemDisplayName');
    const badge = document.getElementById('enquiryItemBadge');

    if (name) {
      displayName.innerText = name;
      badge.innerText = type ? type.toUpperCase() : 'COMMERCIAL';
      displayGroup.style.display = 'block';
    } else {
      displayGroup.style.display = 'none';
    }

    if (window.bootstrap) {
      const modal = new bootstrap.Modal(modalEl);
      modal.show();
    }
  }
</script>
