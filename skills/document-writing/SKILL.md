---
name: document-writing
description: Draft, review, rewrite, and refine project documents such as requirements, README files, design notes, guides, and internal documentation. Use when Codex needs to create new documentation, review wording or structure, improve clarity, reduce accidental repetition while preserving intentional emphasis, align terminology across documents, detect ambiguity, check consistency between related documents, or run a post-edit language pass after larger content changes.
---

# Document Writing

## Overview

Draft new documents and improve existing ones without flattening the author's intent.
Keep important repetition when it carries structure or emphasis, and remove repetition that reads like drift or careless reuse.

## Workflow

1. Identify the job type before editing.
   `draft`: create a new document from source context and constraints.
   `review`: inspect the document and report issues, risks, ambiguities, and wording hotspots before changing anything.
   `targeted-edit`: revise a named section, issue, or wording concern.
   `full-polish`: review the full document for clarity, repetition, flow, and consistency.
2. Read the governing context before changing text.
   In this repository, read [AGENTS.md](../../../AGENTS.md) first, then the target document and any source material it depends on.
   Preserve defined terminology, product positioning, and SSOT facts.
3. Build a quick language map.
   Note repeated nouns, verbs, and framing words in headings, adjacent sentences, and within each paragraph.
   Pay attention to words introduced by earlier edits; replacing one hotspot can create another.
4. Separate intentional repetition from accidental repetition.
   Keep repetition that anchors a concept, defined term, section theme, contrast, or rhetorical emphasis.
   Rewrite repetition that clusters in one paragraph, repeats the same sentence shape, or says the same point without adding precision.
5. Revise with the smallest change that fixes the issue.
   Keep the core term in the heading or topic sentence when it matters, then vary surrounding phrasing.
   Prefer local rewrites over broad rewrites unless the paragraph structure is the real problem.
6. Run a second pass after substantial edits.
   Check whether new hotspot words appeared, whether tone shifted, and whether any defined term was diluted.

## Core Capabilities

- `term-check`: verify required vocabulary, detect prohibited or drifting terms, and keep SSOT wording aligned across the document.
- `consistency-review`: compare related documents or sections and flag mismatched feature descriptions, responsibilities, assumptions, dates, or scope.
- `ambiguity-review`: detect vague language, missing actors, weak constraints, and claims that need a condition, metric, or example.
- `change-impact-review`: after edits, identify other passages likely affected by the change and re-check for newly introduced wording hotspots.
- `section-aware-review`: review by section purpose instead of treating the whole document uniformly.
- `audience-rewrite`: adapt the same content for a different reader without changing the underlying facts.

## Review Guidance

- Start with findings, not a general summary.
- Prioritize issues that affect meaning, consistency, readability, or document trust.
- Distinguish between:
  - factual or terminology issues
  - structural issues
  - accidental repetition or awkward phrasing
- For each wording issue, state whether the repetition looks intentional or accidental.
- When useful, provide a small rewrite example, but do not rewrite the whole document unless asked.

## Section Review Heuristics

- `overview` or `vision`: check value proposition, audience clarity, and whether broad claims are supported.
- `requirements`: check for ambiguity, hidden assumptions, and missing conditions or acceptance boundaries.
- `design` or `architecture`: check ownership, component boundaries, and consistency with other technical documents.
- `procedure` or `installation`: check executable order, prerequisites, and whether every step can actually be performed.
- `glossary` or `terminology`: favor strict consistency over stylistic variation.

## Repetition Review Rules

- Treat these as intentional by default:
  - Terms defined by the product or domain
  - Repetition in headings, tables, glossary rows, or comparison columns
  - Repetition that carries a thesis or contrast through a section
  - Repetition needed to avoid ambiguity after subjects change
- Treat these as likely accidental:
  - The same noun or abstract verb appearing several times in one paragraph
  - Consecutive sentences opening with the same word or pattern
  - Repeated “Xすることで” or “Xという” style scaffolding with little added meaning
  - A word becoming dominant after a previous synonym pass
- When uncertain, preserve accuracy first and reduce repetition second.

## Rewrite Tactics

- Replace a repeated abstract noun with a more concrete restatement.
- Convert a noun phrase into a verb phrase, or the reverse.
- Merge two thin sentences that repeat the same subject.
- Split a dense paragraph so one key term does not have to carry every sentence.
- Replace only the supporting occurrence, not the anchor occurrence.
- Use pronouns sparingly; do not introduce ambiguity to avoid repetition.
- Do not swap out domain terms that must stay exact.

## Consistency Review Rules

- Treat the most authoritative source in the current context as SSOT and align secondary documents to it.
- Flag differences in names, role responsibilities, feature scope, optional vs required behavior, and date/version statements.
- If two documents differ but both may be stale, report the conflict instead of guessing.
- When editing one document, scan likely companion documents for the same concept.

## Ambiguity Review Rules

- Flag words such as `適切`, `柔軟`, `必要に応じて`, `簡単`, `自然`, `十分`, `スムーズ` unless the surrounding sentence makes them concrete.
- Flag sentences where the actor is unclear, especially around permissions, responsibilities, and automated behavior.
- Flag claims that need a trigger, threshold, condition, or example to be operational.
- Prefer concrete revision suggestions that add a subject, condition, or measurable outcome.

## Change Impact Review Rules

- After any substantive edit, re-scan nearby headings, summaries, tables, and companion documents for outdated wording.
- Look for secondary effects:
  - a replaced term creating a new hotspot word
  - an updated feature description conflicting with README or requirements text
  - a scope change that leaves examples or tables stale
- Report impacted locations even if they were not part of the original edit request.

## Output Guidance

- If the user asks for edits, patch the document directly and keep the diff focused.
- If the user asks for review, return findings first with file or section references and note whether each issue should be fixed or left as intentional emphasis.
- If the user asks for analysis only, report the hotspots, explain why each one is intentional or accidental, and suggest concise rewrites.
- If the user asks for generation, state the assumed audience and document purpose, draft the document, then run the same repetition review before finishing.
- If the user asks for cross-document review, list the documents compared and identify the current SSOT or note that SSOT is unclear.
- If the user asks for a large update, include a brief change-impact note covering nearby sections or related files that should be revisited.

## Repository References

- Read [references/repetition-review.md](./references/repetition-review.md) when the task is mainly about wording, duplicate phrasing, or post-edit cleanup.
- Read [references/tulpa-document-style.md](./references/tulpa-document-style.md) when working on Tulpa documents and you need the project's terminology, tone, and product framing.
- Read [references/document-review-checklists.md](./references/document-review-checklists.md) when reviewing for ambiguity, consistency, or change impact across one or more documents.
- Read [references/document-templates.md](./references/document-templates.md) when generating a new README, requirement note, design memo, or operating guide.
