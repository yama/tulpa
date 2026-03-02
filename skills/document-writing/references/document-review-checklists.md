# Document Review Checklists

## Terminology Consistency

- Are required project terms used exactly as defined?
- Are discouraged legacy terms still present?
- Does the same concept appear under different names across files?
- Did a rewrite replace a precise product term with a broader synonym?

## Cross-Document Consistency

- Does the README match the requirements and design docs on feature scope?
- Do role names and responsibilities match across all referenced documents?
- Are optional integrations still described as optional everywhere?
- Do version numbers, dates, and status labels agree?

## Ambiguity Review

- Can the reader tell who performs each action?
- Are triggers, timing, and conditions explicit?
- Are broad claims backed by an example, rule, or boundary?
- Would two reasonable readers interpret the sentence differently?

## Change Impact Review

- Which headings, summaries, tables, or bullets mention the changed concept?
- Which companion docs describe the same workflow or feature?
- Did the edit introduce a new repeated word or sentence pattern?
- Did the edit change the implied audience or scope of the section?

## Review Severity

- `must-fix`: factual conflict, terminology violation, or wording that changes behavior.
- `should-fix`: ambiguity, structural weakness, or awkward repetition that harms readability.
- `leave-as-is`: intentional emphasis, glossary repetition, or wording variation with no clear benefit.
