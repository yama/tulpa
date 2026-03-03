---
name: requirements-review
description: Draft, restructure, and review requirements documents so they become reviewable specifications with explicit scope, non-functional requirements, decision boundaries, risks, and tradeoffs. Use when Codex needs to create or improve requirements definitions, product requirements, MVP scope notes, design requirement memos, or review comments for docs such as `docs/requirements.md`, planning notes, or related design documents.
---

# Requirements Review

## Overview

Turn a vision-heavy requirements document into a reviewable specification.
Preserve product intent, then make boundaries, priorities, assumptions, and risks explicit enough that another reviewer can challenge them.

## Workflow

1. Identify the job type before editing.
   `draft`: create a new requirements document or section.
   `review`: inspect the existing document and return findings first.
   `restructure`: add missing review sections and tighten the document shape.
   `targeted-edit`: revise a named section such as scope, NFR, or risks.
2. Read the governing context first.
   In Tulpa, read `AGENTS.md`, then the target requirements file, then nearby design or README files that define scope or terminology.
   Treat project terminology and optional-feature rules as SSOT.
3. Separate four layers that often blur together in requirements docs.
   `vision`: why the product exists.
   `scope`: what this version includes and excludes.
   `rules`: business constraints, data integrity, workflow conditions.
   `delivery`: phase split, MVP cut, validation hooks.
4. Make review surfaces explicit.
   Add or strengthen sections for scope boundary, non-functional requirements, decision rules, risks, tradeoffs, and review checklist when they are missing.
5. Keep AI and external integrations bounded.
   Require human ownership for AI output, define fallback behavior for optional integrations, and state where the system refuses to automate.
6. Re-check for drift after edits.
   Revisit tables, phase definitions, glossary terms, and companion docs that mention the same feature.

## Review Rules

- Start with findings, not praise or summary.
- Prefer `must-fix`, `should-fix`, and `consider` severity labels.
- Flag ambiguity when the actor, trigger, timing, threshold, or fallback is unclear.
- Flag scope risk when a feature appears in MVP, later phases, and future ideas without a boundary.
- Flag non-functional gaps when claims such as `軽量`, `簡単`, `十分`, or `スマホファースト` lack an operational definition.
- Flag policy gaps when legal, privacy, API-terms, or responsibility boundaries are implied but not stated.
- When revising text, patch the document directly and keep the wording concrete.

## Drafting Rules

- Keep sections decision-oriented. A reviewer should be able to answer "what is in?", "what is out?", "what must hold true?", and "what happens on failure?" without inference.
- Prefer explicit section names over implicit prose. If needed, add sections such as `本バージョンのスコープ`, `非機能要件`, `データ整合性ルール`, `リスクとトレードオフ`, and `要件レビューチェックリスト`.
- Use concrete ranges, thresholds, or volumes for NFRs when the product stage allows it. If exact numbers are unknown, state the placeholder as an open decision instead of pretending precision.
- Distinguish current behavior, MVP behavior, and future consideration. Do not let future ideas silently become current requirements.
- Preserve domain vocabulary exactly when the project defines it.

## Output Shape

For `review` tasks, use this order:
1. Findings with severity and file/section references.
2. Open questions or assumptions blocking stronger conclusions.
3. Short summary of structural health only after the findings.

For `draft` or `restructure` tasks:
1. State the assumed audience and release target.
2. Add the missing review sections directly in the document.
3. Note any unresolved decisions that still need product input.

## Repository References

- Read [references/requirements-structure.md](./references/requirements-structure.md) when drafting or restructuring a requirements document and you need section-level guidance, boundary rules, or Tulpa-style examples.
- Read [references/requirements-review-checklist.md](./references/requirements-review-checklist.md) when reviewing for scope, NFR gaps, integrity rules, AI boundary issues, CRM sprawl, legal risk, or missing tradeoff declarations.
