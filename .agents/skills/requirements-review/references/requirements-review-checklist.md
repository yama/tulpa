# Requirements Review Checklist

## Severity

- `must-fix`: behavior, scope, or responsibility would be interpreted differently by reasonable reviewers.
- `should-fix`: the intent is mostly clear but the document is hard to review, estimate, or implement safely.
- `consider`: worthwhile improvement that strengthens reviewability without blocking the current iteration.

## Scope and Phase Control

- Is the current version boundary explicit?
- Does the document distinguish MVP, later phases, and future ideas?
- Are optional integrations still optional everywhere?
- Does any section imply expansion into CRM, accounting, or analytics beyond the stated scope?
- Are `In Scope` and `Out of Scope` both present for the current version?

## Non-Functional Requirements

- Are performance expectations quantified or explicitly marked as open decisions?
- Is the expected scale small enough to match the proposed infrastructure?
- Are availability and backup expectations defined for the intended hosting model?
- Are security rules explicit for API keys, personal data, and access restrictions?
- Does `軽量` or `シンプル` mean something operational?

## Workflow and Data Integrity

- Can the reviewer tell which actor performs each action?
- Are state transitions explicit for submit, return, confirm, generate, and close?
- Is editability clear after confirmation, contract end, or document issuance?
- Are historical values snapshotted where recalculation would be dangerous?
- Is audit history required where transparency matters?

## AI Boundary

- Is AI positioned as assistive rather than authoritative?
- Is human review required before external sharing or operational decisions?
- Is fallback behavior defined when the AI provider is unavailable or unconfigured?
- Is the responsibility for AI mistakes stated or implied?
- Is AI logging, retention, or traceability described where needed?

## Optional Integrations and External Dependencies

- Is the core product still usable without Slack or AI?
- Are API-term or external-content restrictions acknowledged for public or cached data?
- Is manual fallback described when external APIs fail?
- Are sync timing and cache freshness expectations defined?

## Legal and Privacy Risk

- Does the terminology avoid implying employment control where that is legally risky?
- Are public profile visibility controls explicit and default-safe?
- Is responsibility for incorrect public data or third-party content surfaced?
- Are personal and contractual data boundaries clear?

## Tulpa-Specific Risk Prompts

- Does the CRM scope stay limited to approach history and next action, rather than expanding into full sales management?
- Does the public profile section avoid exposing client names, unit prices, or confidential contract details?
- Does the PWA section state the iOS notification limitation clearly enough for product expectations?
- Does the requirements doc state that AI matching supports judgment rather than replaces it?

## Reviewer Output Format

Return findings in this shape when asked to review:

1. Severity + location
2. Why the requirement is hard to review, risky, or inconsistent
3. The missing boundary, metric, rule, or decision
4. Optional fix direction if a concrete rewrite is obvious
