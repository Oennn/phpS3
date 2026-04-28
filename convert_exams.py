#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import markdown2
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import mm
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, PageBreak
from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER, TA_LEFT, TA_JUSTIFY
import os
import html
import re

def markdown_to_pdf(md_file, pdf_file):
    """Convertit un fichier markdown en PDF avec styling"""

    # Lecture du fichier markdown
    with open(md_file, 'r', encoding='utf-8') as f:
        md_content = f.read()

    # Création du document PDF
    doc = SimpleDocTemplate(
        pdf_file,
        pagesize=A4,
        rightMargin=15*mm,
        leftMargin=15*mm,
        topMargin=15*mm,
        bottomMargin=15*mm
    )

    # Styles
    styles = getSampleStyleSheet()

    # Styles personnalisés
    style_title = ParagraphStyle(
        'CustomTitle',
        parent=styles['Heading1'],
        fontSize=16,
        textColor=colors.HexColor('#1a1a1a'),
        spaceAfter=12,
        alignment=TA_CENTER,
        fontName='Helvetica-Bold'
    )

    style_heading2 = ParagraphStyle(
        'CustomHeading2',
        parent=styles['Heading2'],
        fontSize=12,
        textColor=colors.HexColor('#2c3e50'),
        spaceAfter=8,
        spaceBefore=10,
        fontName='Helvetica-Bold'
    )

    style_heading3 = ParagraphStyle(
        'CustomHeading3',
        parent=styles['Heading3'],
        fontSize=11,
        textColor=colors.HexColor('#34495e'),
        spaceAfter=6,
        spaceBefore=8,
        fontName='Helvetica-Bold'
    )

    style_body = ParagraphStyle(
        'CustomBody',
        parent=styles['BodyText'],
        fontSize=10,
        alignment=TA_JUSTIFY,
        spaceAfter=6
    )

    style_code = ParagraphStyle(
        'CodeStyle',
        parent=styles['BodyText'],
        fontSize=9,
        textColor=colors.HexColor('#333333'),
        backColor=colors.HexColor('#f5f5f5'),
        leftIndent=10,
        rightIndent=10,
        spaceAfter=8,
        fontName='Courier'
    )

    story = []
    lines = md_content.split('\n')

    i = 0
    while i < len(lines):
        line = lines[i].strip()

        # Titre principal (#)
        if line.startswith('# ') and not line.startswith('## '):
            text = line[2:].strip()
            story.append(Paragraph(text, style_title))
            story.append(Spacer(1, 0.2*mm))
            i += 1

        # Heading 2 (##)
        elif line.startswith('## ') and not line.startswith('### '):
            text = line[3:].strip()
            story.append(Paragraph(text, style_heading2))
            story.append(Spacer(1, 0.1*mm))
            i += 1

        # Heading 3 (###)
        elif line.startswith('### '):
            text = line[4:].strip()
            story.append(Paragraph(text, style_heading3))
            i += 1

        # Code block (```)
        elif line.startswith('```'):
            code_lines = []
            i += 1
            while i < len(lines) and not lines[i].strip().startswith('```'):
                code_lines.append(html.escape(lines[i]))
                i += 1
            i += 1  # Skip closing ```

            code_text = '<br/>'.join(code_lines)
            story.append(Paragraph(f"<font face='Courier' size='8'>{code_text}</font>", style_code))
            story.append(Spacer(1, 0.1*mm))

        # Horizontal line (---)
        elif line == '---':
            story.append(Spacer(1, 0.2*mm))
            i += 1

        # Paragraphe normal
        elif line:
            # Formatage: **bold** -> <b>, *italic* -> <i>
            formatted = re.sub(r'\*\*(.+?)\*\*', r'<b>\1</b>', line)
            formatted = re.sub(r'\*(.+?)\*', r'<i>\1</i>', formatted)
            formatted = re.sub(r'`(.+?)`', r'<font face="Courier">\1</font>', formatted)

            story.append(Paragraph(formatted, style_body))
            story.append(Spacer(1, 0.05*mm))
            i += 1

        else:
            i += 1

    # Construction du PDF
    try:
        doc.build(story)
        print(f"✓ PDF créé : {pdf_file}")
    except Exception as e:
        print(f"✗ Erreur lors de la création du PDF : {e}")

if __name__ == '__main__':
    # Conversion des 3 nouveaux sujets
    sujets = [
        ('exam_web3_sujetA.md', 'exam_web3_sujetA.pdf'),
        ('exam_web3_sujetC.md', 'exam_web3_sujetC.pdf'),
        ('exam_web3_sujetD.md', 'exam_web3_sujetD.pdf'),
    ]

    for md_file, pdf_file in sujets:
        markdown_to_pdf(md_file, pdf_file)

